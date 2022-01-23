<?php

namespace App\Http\Controllers;

use App\Models\Aanmelding;
use App\Models\Actie;
use Illuminate\Support\Facades\Auth;
use Voyager;

class AanmeldingController extends Controller
{
    public function index()
    {
        // Haal aanmeldingen van deze gebruiker op
        $aanmeldingen = auth()->user()->aanmeldingen()->get();
        return view('theme::aanmeldingen.index', compact('aanmeldingen'));
    }

    public function landing() {

        if(Auth::check()) {
            return redirect(route('aanmelding.form'));
        }

        // Display the landing page
        return view('theme::aanmeldingen.landing');
    }

    public function aanmelden() {
        // Display the landing page
        return view('theme::aanmeldingen.form');
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

        // create new actie
        $actie = new Actie();

        $actieProperties = array_only($aanmelding->attributesToArray(), [
            'user_id',
            'title',
            'body',
            'externe_link',
            'time_start',
            'time_end',
            'location',
            'location_human',
            'image',
        ]);
        $actieProperties['slug'] = $this->createSlug($actieProperties['title']);

        $actie->fill($actieProperties);
        $actie->save();

        $aanmelding->approve();

        return redirect()
            ->route("voyager.acties.index")
            ->with([
                'message'    => __('aanmeldingen.approve_success'),
                'alert-type' => 'success',
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
