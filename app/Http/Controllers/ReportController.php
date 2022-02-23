<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use App\Models\Image;
use App\Models\Organizer;
use App\Models\Report;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        if (Auth::check()) {
            return redirect(route('report.form'));
        }

        // Display the landing page
        return view('reports.landing');
    }

    /**
     * Displays the form to create a new Report
     */
    public function form()
    {
        $organizers = Organizer::all()->toJson();
        $viewOnly = false;
        // Display the landing page
        return view('reports.form', compact('viewOnly', 'organizers'));
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
            $report = Report::create([
                'user_id' => auth()->user()->id,
                'organizer_ids' => $request->organizer_ids ? implode(",", $request->organizer_ids) : '',
                'title' => $request->title,
                'body' => $request->body,
                'externe_link' => $request->externe_link,
                'time_start' => Date::parse($request->time_start)->format('Y-m-dTH:i'),
                'time_end' => Date::parse($request->time_end)->format('Y-m-dTH:i'),
                'location' => DB::raw("ST_GeomFromText('POINT({$request->location['lng']} {$request->location['lat']})')"),
                'location_human' => $request->location_human,
            ]);
            if ($request->image) {
                $ext = '.' . explode('/', mime_content_type($request->image))[1];
                $path = 'reports/' . md5($request->title . microtime()) . $ext;
                // Store the image on the server
                Storage::disk(config('voyager.storage.disk'))->put($path, file_get_contents($request->image));
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
            return back()->with('error', $errorInfo[2])->withInput();
        }

        return redirect(route('dashboard'))->with('success', __('reports.add_success'));
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
                'message'    => __('reports.approve_fail'),
                'alert-type' => 'error',
            ]);
        }

        // Move image to actie folder
        $newImagePath = 'acties/' . explode("/", $report->image)[1];
        Storage::disk(config('voyager.storage.disk'))->copy($report->image, $newImagePath);

        // create new actie
        $actie = Actie::create([
            'user_id' => $report->user_id,
            'title' => $report->title,
            'body' => $report->body,
            'externe_link' => $report->externe_link,
            'time_start' => $report->time_start,
            'time_end' => $report->time_end,
            'location' => DB::raw("ST_GeomFromText('POINT({$report->coordinates['lng']} {$report->coordinates['lat']})')"),
            'location_human' => $report->location_human,
            'image' => $newImagePath,
            'slug' => $this->createSlug($report->title),
        ]);
        Image::create([
            'path' => $newImagePath,
            'actie_id' => $actie->id,
        ]);

        // Add a relationship entry for the ActieOrganizer if the organizer_id is passed
        if ($report->organizer_ids) {
            $report_ids = explode(",", $report->organizer_ids);
            foreach($report_ids as $report_id) {
                $actie->organizers()->save(Organizer::firstWhere('id', $report_id));
            }
        }

        $report->approve();

        return redirect()
            ->route("voyager.acties.index")
            ->with([
                'message'    => __('reports.approve_success'),
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
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:16000',
            'externe_link' => 'required|string|url|max:500',
            'time_start' => 'required|date_format:Y-m-d\TH:i|after_or_equal:today',
            'time_end' => 'required|date_format:Y-m-d\TH:i|after:time_start',
            'location' => 'array:lat,lng',
            'location_human' => 'required|string|max:200',
            'image' => '',
        ]);
    }

    protected function createSlug($title)
    {
        $slug = str_slug($title);
        $allSlugs = Actie::select('slug')->where('slug', '=', $slug)->get();
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
