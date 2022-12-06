<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Voyager;

class ActieController extends VoyagerBaseController
{
    public function actie($slug)
    {

        $actie = Actie::where('slug', '=', $slug)->firstOrFail();

        if (!$actie->published) {
            abort(404);
        }

        // SEO
        SEOTools::setTitle($actie->title);
        if ($actie->excerpt !== null) {
            SEOTools::setDescription($actie->excerpt);
        }
        if ($actie->keywords !== null) {
            SEOMeta::setKeywords($actie->keywords);
        }

        // Pass admin attribute
        $isAdmin = false;
        if (auth()->user()) {
            $isAdmin = auth()->user()->hasRole('admin');
        }

        return view('acties.actie', compact('actie', 'isAdmin'));
    }

    public function search(Request $request)
    {
        $query = Actie::query();
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('body', 'LIKE', '%' . $request->q . '%');
            });
        }
        if ($request->themes) {
            $requestThemes = is_array($request->themes) ? $request->themes : array($request->themes);
            $query->whereHas('themes', function ($q) use ($requestThemes) {
                $q->whereIn('theme_id', $requestThemes);
            });
        }
        if ($request->categories) {
            $requestCategories = is_array($request->categories) ? $request->categories : array($request->categories);
            $query->whereHas('categories', function ($q) use ($requestCategories) {
                $q->whereIn('category_id', $requestCategories);
            });
        }
        if ($request->organizer) {
            $requestOrganizer = is_array($request->organizer) ? $request->organizer : array($request->organizer);
            $query->whereHas('organizers', function ($q) use ($requestOrganizer) {
                $q->whereIn('organizer_id', $requestOrganizer);
            });
        }
        if ($request->coordinates) {
            $coordinates = explode(',', $request->coordinates);
            $radius = ($request->distance ?? 9999) * 1000;
            $query->whereRaw("ST_Distance_Sphere(location, ST_GeomFromText('POINT({$coordinates[1]} {$coordinates[0]})')) <= {$radius}");
        }
        if ($request->show_past === 'false') {
            $acties = $query->published()->orderBy('time_start')->toekomstig()->paginate(12);
        } else {
            $acties = $query->published()->orderBy('time_start')->paginate(12);
        }
        
        
        return response()->json(['acties' => $acties]);
    }

    public function publish($id)
    {
        $dataTypeActies = Voyager::model('DataType')->where('slug', '=', 'acties')->first();

        // Check permissions
        $this->authorize('edit', app($dataTypeActies->model_name));

        // get report data
        $actie = Actie::findOrFail($id);

        // check if status is actually a draft to be published
        if ($actie->status !== 'DRAFT') {
            return back()
            ->with([
                'message'    => __('general.publish_fail', ['entity' => 'Actie']),
                'alert-type' => 'error',
            ]);
        }

        // change actie status
        $actie->publish();

        return redirect()
            ->route("voyager.acties.index")
            ->with([
                'message'    => __('general.publish_success', ['entity' => 'Actie']),
                'alert-type' => 'success',
            ]);
    }
}
