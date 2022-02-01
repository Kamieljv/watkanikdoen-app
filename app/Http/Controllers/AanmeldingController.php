<?php

namespace App\Http\Controllers;

use App\Models\Aanmelding;
use App\Models\Actie;
use App\Models\Organizer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use Validator;

use Voyager;

class AanmeldingController extends Controller
{

    /**
     * Displays the 'landing' page for unauthenticated users
     */
    public function landing()
    {

        if (Auth::check()) {
            return redirect(route('aanmelding.form'));
        }

        // Display the landing page
        return view('aanmeldingen.landing');
    }

    /**
     * Displays the form to create a new Aanmelding
     */
    public function form()
    {
        $organizers = Organizer::all()->toJson();
        $viewOnly = false;
        // Display the landing page
        return view('aanmeldingen.form', compact('viewOnly', 'organizers'));
    }
    /**
     * Displays the filled in Aanmelding form
     */
    public function view($id)
    {
        $aanmelding = auth()->user()->aanmeldingen()->firstWhere('id', $id);
        if (!$aanmelding) {
            abort(404);
        } else {
            $organizers = Organizer::whereIn('id', explode(",", $aanmelding->organizer_ids))
                ->pluck('name')->all();
            $viewOnly = true;
            return view('aanmeldingen.form', compact('viewOnly', 'organizers', 'aanmelding'));
        }
    }

    public function create(Request $request)
    {
        $this->validator($request->all())->validate();

        try {
            $aanmelding = Aanmelding::create([
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
                $path = 'aanmeldingen/'. uniqid() . '.png';
                Storage::disk(config('voyager.storage.disk'))->put($path, file_get_contents($request->image));
                $aanmelding->image = $path;
                $aanmelding->save();
            }
        } catch (QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return back()->with('error', $errorInfo[2])->withInput();
        }

        return redirect(route('dashboard'))->with('success', 'Successfully added Aanmelding.');
    }

    public function approve($id)
    {
        $dataTypeAanmeldingen = Voyager::model('DataType')->where('slug', '=', 'aanmeldingen')->first();
        $dataTypeActies = Voyager::model('DataType')->where('slug', '=', 'acties')->first();

        // Check permissions
        $this->authorize('edit', app($dataTypeAanmeldingen->model_name));
        // Check permissions
        $this->authorize('add', app($dataTypeActies->model_name));

        // get aanmelding data
        $aanmelding = Aanmelding::findOrFail($id);

        if ($aanmelding->status !== 'PENDING') {
            return back()
            ->with([
                'message'    => __('aanmeldingen.approve_fail'),
                'alert-type' => 'error',
            ]);
        }

        // Move image to actie folder
        $newImagePath = 'acties/' . explode("/", $aanmelding->image)[1];
        Storage::disk(config('voyager.storage.disk'))->move($aanmelding->image, $newImagePath);
        $aanmelding->image = $newImagePath;
        $aanmelding->save();

        // create new actie
        $actie = Actie::create([
            'user_id' => $aanmelding->user_id,
            'title' => $aanmelding->title,
            'body' => $aanmelding->body,
            'externe_link' => $aanmelding->externe_link,
            'time_start' => $aanmelding->time_start,
            'time_end' => $aanmelding->time_end,
            'location' => DB::raw("ST_GeomFromText('POINT({$aanmelding->coordinates['lng']} {$aanmelding->coordinates['lat']})')"),
            'location_human' => $aanmelding->location_human,
            'image' => $newImagePath,
            'slug' => $this->createSlug($aanmelding->title),
        ]);

        // Add a relationship entry for the ActieOrganizer if the organizer_id is passed
        if ($aanmelding->organizer_ids) {
            $aanmelding_ids = explode(",", $aanmelding->organizer_ids);
            foreach($aanmelding_ids as $aanmelding_id) {
                $actie->organizers()->save(Organizer::firstWhere('id', $aanmelding_id));
            }
        }

        $aanmelding->approve();

        return redirect()
            ->route("voyager.acties.index")
            ->with([
                'message'    => __('aanmeldingen.approve_success'),
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
