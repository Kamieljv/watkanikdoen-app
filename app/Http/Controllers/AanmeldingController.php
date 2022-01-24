<?php

namespace App\Http\Controllers;

use App\Models\Aanmelding;
use App\Models\Actie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Validator;

use Voyager;

class AanmeldingController extends Controller
{
    /**
     * Displays the 'aanmeldingen' page for authenticated users
     */
    public function index()
    {
        // Haal aanmeldingen van deze gebruiker op
        $aanmeldingen = auth()->user()->aanmeldingen()->get();
        return view('theme::aanmeldingen.index', compact('aanmeldingen'));
    }

    /**
     * Displays the 'landing' page for unauthenticated users
     */
    public function landing()
    {

        if (Auth::check()) {
            return redirect(route('aanmelding.form'));
        }

        // Display the landing page
        return view('theme::aanmeldingen.landing');
    }

    /**
     * Displays the form to create a new Aanmelding
     */
    public function form()
    {
        // Display the landing page
        return view('theme::aanmeldingen.form');
    }

    public function create(Request $request)
    {
        Log::debug($request->all());

        $this->validator($request->all())->validate();

        try {
            $aanmelding = Aanmelding::create([
                'user_id' => auth()->user()->id,
                'title' => $request->get('title'),
                'body' => $request->get('body'),
                'externe_link' => $request->get('externe_link'),
                'time_start' => Date::parse($request->get('time_start'))->format('Y-m-dTH:i'),
                'time_end' => Date::parse($request->get('time_end'))->format('Y-m-dTH:i'),
                'location' => DB::raw("ST_GeomFromText('POINT({$request->get('location')['lng']} {$request->get('location')['lat']})')"),
                'location_human' => $request->get('location_human'),
                'image' => $request->get('image'),
            ]);
        } catch (QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;
            return back()->with('error', $errorInfo[2])->withInput();
        }

        return redirect(route('aanmeldingen'))->with('success', 'Successfully added Aanmelding.');
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

        // Get coordinates from aanmelding
        $coordinates = $aanmelding->getCoordinates()[0];

        // create new actie
        $actie = Actie::create([
            'user_id' => $aanmelding->user_id,
            'title' => $aanmelding->title,
            'body' => $aanmelding->body,
            'externe_link' => $aanmelding->externe_link,
            'time_start' => $aanmelding->time_start,
            'time_end' => $aanmelding->time_end,
            'location' => DB::raw("ST_GeomFromText('POINT({$coordinates['lng']} {$coordinates['lat']})')"),
            'location_human' => $aanmelding->location_human,
            'image' => $aanmelding->image,
            'slug' => $this->createSlug($aanmelding->title),
        ]);

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
