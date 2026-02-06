<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use App\Models\Organizer;
use App\Models\Report;
use App\Models\Status;
use App\Models\User;
use App\Notifications\Mail\ReportAccepted;
use App\Notifications\Mail\ReportReceived;
use App\Rules\Website;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MWGuerra\FileManager\Models\FileSystemItem;
use Stevebauman\Purify\Facades\Purify;
use Validator;

class ReportController extends Controller
{
    /**
     * Displays the 'landing' page for unauthenticated users
     */
    public function landing()
    {
        // Definieer de routes waarmee de component evenementen kan ophalen
        $routes = collect(Route::getRoutes()->getRoutesByName())->filter(function ($route) {
            return (strpos($route->uri, 'organisatoren') !== false || strpos($route->uri, 'organisator') !== false) && (strpos($route->uri, 'admin') === false);
        })->map(function ($route) {
            return [
                'uri' => '/' . $route->uri,
                'methods' => $route->methods,
            ];
        })->toArray();

        // Display the landing page
        return view('reports.landing', compact('routes'));
    }

    /**
     * Displays the filled in Report form
     */
    public function view($id)
    {
        $report = auth()->user()->reports()->firstWhere('id', $id);
        if (!$report) {
            abort(404);
        } else {
            $organizers = Organizer::whereIn('id', explode(",", $report->organizer_ids))
                ->pluck('name')->all();
            $viewOnly = true;
            return view('reports.form', compact('viewOnly', 'organizers', 'report'));
        }
    }

    public function create(Request $request)
    {
        // check if user is logged in and reported userId matched logged-in user

        if (auth()->user()->id !== (int) $request->userId) {
            return response([
                'status' => 'error',
                'message' => __('reports.user_mismatch'),
            ], 200);
        }

        $this->validator($request->all())->validate();

        try {
            // create organizers
            $organizer_ids = [];
            if (count($request->organizers) > 0) {
                foreach($request->organizers as $organizer) {
                    if (!isset($organizer['id'])) {
                        $org = Organizer::create([
                            'name' => $organizer['name'],
                            'description' => $organizer['description'] ?? null,
                            'website' => $organizer['website'],
                            'slug' => $this->createSlug($organizer['name'], Organizer::class),
                            'user_id' => $request->userId,
                            'status' => 'PENDING',
                        ]);
                        array_push($organizer_ids, $org->id);
                    } else {
                        array_push($organizer_ids, $organizer['id']);
                    }
                }   
            }
            // create report
            $report = Report::create([
                'user_id' => $request->userId,
                'organizer_ids' => $organizer_ids ? implode(",", $organizer_ids) : '',
                'title' => $request->report['title'],
                'body' => $request->report['body'] ? Purify::clean($request->report['body']) : null,
                'externe_link' => $request->report['actionUrls'],
                'start_date' => Carbon::parse($request->report['start_date'])->format('Y-m-d'),
                'end_date' => Carbon::parse($request->report['end_date'])->format('Y-m-d'),
                'start_time' => isset($request->report['start_time']) ? Carbon::parse($request->report['start_time'])->format('H:i') : null,
                'end_time' => isset($request->report['end_time']) ? Carbon::parse($request->report['end_time'])->format('H:i') : null,
                'location' => isset($request->report['location']) ?
                    new Point($request->report['location']['lat'], $request->report['location']['lng']) : null,
                'location_human' => $request->report['location_human'],
            ]);
            if (isset($request->report['image'])) {
                // Construct file path
                $ext = '.' . explode('/', mime_content_type($request->report['image']))[1];
                $filePath = 'reports/' . md5($request->report['title'] . microtime()) . $ext;
                
                // Get parent folder id
                $folderId = FileSystemItem::where('name', 'reports')
                    ->where('type', 'folder')
                    ->first()->id ?? null;

                // Create entry in db
                $fileSystemItem = FileSystemItem::firstOrCreate([
                    'storage_path' => $filePath,
                ], [
                    'parent_id' => $folderId,
                    'name' => basename($filePath),
                    'type' => 'file',
                    'file_type' => 'image',
                    'size' => filesize(storage_path('app/public/' . $filePath)),
                    'storage_path' => $filePath,
                ]);

                // Attach new image
                $report->image()->attach($fileSystemItem->id);

                // Store the image on the server
                Storage::disk('public')->put($filePath, file_get_contents($request->report['image']));
            }
        } catch (QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response([
                'status' => 'error',
                'message' => $errorInfo[2],
            ], 200);
        }

        // Send email notification to admin
        if(config('app.debug') == false){
            $admin = User::whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->first();
            $admin->notify(new ReportReceived($report));
        }
        return response([
            'status' => 'success',
            'message' => __('reports.add_success'),
        ], 200);
    }

    public function approve($id)
    {
        // Check permissions
        auth()->user()->can(['edit_reports', 'add_acties']);

        // get report data
        $report = Report::findOrFail($id);

        if ($report->status !== Status::PENDING->name) {
            Notification::make()
                ->title(__('general.approve_fail', ['entity' => 'Actie']))
                ->danger()
                ->send();
            return back();
        }

        // Get organizers and check if published
        if ($report->organizer_ids) {
            $organizers = [];
            foreach ($report->organizer_ids as $org_id) {
                $org = Organizer::firstWhere('id', $org_id);
                if ($org->status !== Status::PUBLISHED->name) {
                    Notification::make()
                        ->title(__('general.approve_fail_organizer_not_published', ['entity' => 'Actie']))
                        ->danger()
                        ->send();
                    return back();
                }
                array_push($organizers, $org);
            }
        }

        // Move image to actie folder
        if ($report->image()->exists()) {
            $image = $report->image()->first();
            $oldPath = $image->storage_path;
            $newPath = 'acties/' . basename($oldPath);
            try {
                Storage::disk('public')->copy($oldPath, $newPath);
            } catch (\Throwable $e) {
                Notification::make()
                    ->title(__('general.approve_fail', ['entity' => 'Actie']))
                    ->danger()
                    ->send();
                return back();
            }

            // update image path in db
            $image->storage_path = $newPath;
            $image->save();

            // Set parent folder to 'acties'
            $actieFolderId = FileSystemItem::where('name', 'acties')
                ->where('type', 'folder')
                ->first()->id ?? null;
            FileSystemItem::where('storage_path', $oldPath)
                ->update(['parent_id' => $actieFolderId]);
        }

        // create new actie
        $actie = Actie::create([
            'user_id' => $report->user_id,
            'title' => $report->title,
            'body' => $report->body,
            'externe_link' => $report->externe_link,
            'start_date' => $report->start_date,
            'start_time' => $report->start_time,
            'end_date' => $report->end_date,
            'end_time' => $report->end_time,
            'location' => $report->location,
            'location_human' => $report->location_human,
            'slug' => $this->createSlug($report->title),
        ]);
        // Attach the new image if exists
        if (isset($image)) {
            $actie->image()->attach($image->id);
        }
        // attach organizers to actie
        if (isset($organizers)) {
            foreach ($organizers as $org) {
                $actie->organizers()->save($org);
            }
        }        

        $report->approve();

        $report->actie_id = $actie->id;
        $report->save();

        Notification::make()
            ->title(__('general.approve_success', ['entity' => 'Actie']))
            ->success()
            ->send();

        if (!$report->reporter_notified) {
            // Notify the user that issued the report
            $report->user->notify(new ReportAccepted($actie));
            $report->reporter_notified = 1;
            $report->save();
        }

        return redirect()
            ->route('filament.admin.resources.acties.edit', ['record' => $actie->id]);
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $v = Validator::make($data, [
            'userId' => 'required|integer',

            'report.title' => 'required|string|max:255',
            'report.body' => 'required|string|max:16000',
            'report.actionUrls' => 'required|array',
            'report.actionUrls.*' => 'url|max:500',
            'report.start_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'report.start_time' => 'date_format:H:i',
            'report.end_date' => 'required|date_format:Y-m-d|after_or_equal:report.start_date',
            'report.end_time' => 'date_format:H:i',

            'report.location' => 'array:lat,lng',
            'report.location_human' => 'required|string|max:200',
            'report.image' => '',
            
            'organizers.*.name' => 'sometimes|required|string|unique:organizers|max:80',
            'organizers.*.description' => 'sometimes|string|max:16000',
            'organizers.*.website' => ['sometimes', 'required', 'string', 'max:500', new Website()]
        ], [
            'organizers.*.name.unique' => 'De organisatornaam :input bestaat al.',
            'report.end_time' => 'Het einde van de actie moet na het begin zijn.'
        ]);

        // Add rule (end_time must be after start_time) for when start_date and end_date are the same
        $v->sometimes('report.end_time', 'date_format:H:i|after:report.start_time', function ($data) {
            return $data->report['start_date'] == $data->report['end_date'];
        });

        return $v;
    }

    protected function createSlug($title, $model = Actie::class)
    {
        $slug = str_slug($title);
        $allSlugs = $model::select('slug')->where('slug', '=', $slug)->get();
        if (! $allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
}
