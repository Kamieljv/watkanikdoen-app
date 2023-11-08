<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use App\Models\Category;
use App\Models\Theme;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Voyager;

class ActieController extends VoyagerBaseController
{
    public function agenda()
    {
        // Definieer de routes waarmee de component evenementen kan ophalen
        $routes = collect(Route::getRoutes()->getRoutesByName())->filter(function ($route) {
            return (strpos($route->uri, 'acties') !== false) && (strpos($route->uri, 'admin') === false);
        })->map(function ($route) {
            return [
                'uri' => '/' . $route->uri,
                'methods' => $route->methods,
            ];
        });

        $themes = Theme::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        // SEO
        SEOTools::setTitle('Acties');

        return view('acties.agenda', compact('routes', 'themes', 'categories'));
    }

    public function actie($slug)
    {

        $actie = Actie::where('slug', '=', $slug)->firstOrFail();

        if (!$actie->published) {
            abort(404);
        }

        $routes = collect(Route::getRoutes()->getRoutesByName())->filter(function ($route) {
            return (strpos($route->uri, 'acties') !== false) && (strpos($route->uri, 'admin') === false);
        })->map(function ($route) {
            return [
                'uri' => '/' . $route->uri,
                'methods' => $route->methods,
            ];
        });


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

        // count acties with the same theme
        $actieThemes = array_column($actie->themes->toArray(), 'id');
        $count_same_theme = Actie::query()
            ->whereHas('themes', function ($q) use ($actieThemes) {
                $q->whereIn('theme_id', $actieThemes);
            }) // where theme in $actieThemes
            ->whereNot('id', $actie->id) // exclude current action
            ->published()->toekomstig()->count();

        return view('acties.actie', compact('actie', 'routes', 'isAdmin', 'count_same_theme'));
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

        $query->published()->orderBy('time_start');

        if ($request->show_past === 'false') {
            $query->toekomstig();
        }

        if ($request->limit) {
            $acties = $query->limit($request->limit)->get();
        } else {
            $acties = $query->paginate(12);
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
