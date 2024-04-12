<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use App\Models\Image;
use App\Models\Organizer;
use App\Models\Report;
use App\Models\User;
use App\Notifications\Mail\ReportReceived;
use App\Rules\Website;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use Validator;
use Voyager;

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
            $externe_link = str_replace("\n", "", $request->report['actionUrls']);
            $report = Report::create([
                'user_id' => $request->userId,
                'organizer_ids' => $organizer_ids ? implode(",", $organizer_ids) : '',
                'title' => $request->report['title'],
                'body' => $request->report['body'] ?? null,
                'externe_link' => $request->report['externe_link'],
                'start_date' => Date::parse($request->report['start_date'])->format('Y-m-d'),
                'end_date' => Date::parse($request->report['end_date'])->format('Y-m-d'),
                'start_time' => isset($request->report['start_time']) ? Date::parse($request->report['start_time'])->format('H:i') : null,
                'end_time' => isset($request->report['end_time']) ? Date::parse($request->report['end_time'])->format('H:i') : null,
                'location' => isset($request->report['location']) ?
                    DB::raw("ST_GeomFromText('POINT({$request->report['location']['lng']} {$request->report['location']['lat']})')") : null,
                'location_human' => $request->report['location_human'],
            ]);
            if (isset($request->report['image'])) {
                $ext = '.' . explode('/', mime_content_type($request->report['image']))[1];
                $path = 'reports/' . md5($request->report['title'] . microtime()) . $ext;
                // Store the image on the server
                Storage::disk(config('voyager.storage.disk'))->put($path, file_get_contents($request->report['image']));
                // Create entry in db
                Image::create([
                    'path' => $path,
                    'report_id' => $report->id,
                ]);
                // Also save image on the model
                $report->image = $path;
                $report->save();
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
            $admin = User::where('username', 'admin')->first();
            $admin->notify(new ReportReceived($report));
        }
        return response([
            'status' => 'success',
            'message' => __('reports.add_success'),
        ], 200);
    }

    public function approve($id)
    {
        $dataTypeReports = Voyager::model('DataType')->where('slug', '=', 'reports')->first();
        $dataTypeActies = Voyager::model('DataType')->where('slug', '=', 'acties')->first();

        // Check permissions
        $this->authorize('edit', app($dataTypeReports->model_name));
        // Check permissions
        $this->authorize('add', app($dataTypeActies->model_name));

        // get report data
        $report = Report::findOrFail($id);

        if ($report->status !== 'PENDING') {
            return back()
            ->with([
                'message'    => __('general.approve_fail', ['entity' => 'Actie']),
                'alert-type' => 'error',
            ]);
        }

        // Add a relationship entry for the ActieOrganizer if the organizer_id is passed
        if ($report->organizer_ids) {
            $organizer_ids = explode(",", $report->organizer_ids);
            $organizers = [];
            foreach ($organizer_ids as $org_id) {
                $org = Organizer::firstWhere('id', $org_id);
                if ($org->status !== 'PUBLISHED') {
                    return back()
                    ->with([
                        'message'    => __('general.approve_fail_organizer_not_published', ['entity' => 'Actie']),
                        'alert-type' => 'error',
                    ]);
                }
                array_push($organizers, $org);
            }
        }

        // Move image to actie folder
        if ($report->image) {
            $newImagePath = 'acties/' . explode("/", $report->image)[1];
            try {
                Storage::disk(config('voyager.storage.disk'))->copy($report->image, $newImagePath);
            } catch (\Throwable $e) {
                return back()
                    ->with([
                        'message'    => __('general.approve_fail_error_message', ['entity' => 'Actie', 'error' => $e->getMessage()]),
                        'alert-type' => 'error',
                    ]);
            }
            
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
            'location' => $report->coordinates ? DB::raw("ST_GeomFromText('POINT({$report->coordinates['lng']} {$report->coordinates['lat']})')") : null,
            'location_human' => $report->location_human,
            'image' => $report->image ? $newImagePath : '',
            'slug' => $this->createSlug($report->title),
        ]);
        if (isset($newImagePath)) {
            Image::create([
                'path' => $newImagePath,
                'actie_id' => $actie->id,
            ]);
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

        return redirect()
            ->route("voyager.acties.index")
            ->with([
                'message'    => __('general.approve_success', ['entity' => 'Actie']),
                'alert-type' => 'success',
            ]);
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'userId' => 'required|integer',

            'report.title' => 'required|string|max:255',
            'report.body' => 'required|string|max:16000',
<<<<<<< HEAD
            'report.actionUrls' => ['required', 'string', 'max:1500'],
            'report.time_start' => 'required|date_format:Y-m-d\TH:i|after_or_equal:today',
            'report.time_end' => 'required|date_format:Y-m-d\TH:i|after:time_start',
=======
            'report.externe_link' => ['required', 'string', 'max:500', new Website()],
            'report.start_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'report.start_time' => 'date_format:H:i',
            'report.end_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'report.end_time' => 'date_format:H:i',

>>>>>>> actie-start-time
            'report.location' => 'array:lat,lng',
            'report.location_human' => 'required|string|max:200',
            'report.image' => '',
            
            'organizers.*.name' => 'sometimes|required|string|unique:organizers|max:80',
            'organizers.*.description' => 'sometimes|string|max:16000',
            'organizers.*.website' => ['sometimes', 'required', 'string', 'max:500', new Website()]
        ], [
            'organizers.*.name.unique' => 'De organisatornaam :input bestaat al.'
        ]);
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
