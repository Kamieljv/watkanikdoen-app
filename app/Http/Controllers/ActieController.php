<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use App\Models\Category;
use App\Models\Theme;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ActieController extends Controller
{
    public function agenda(Request $request)
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

        $themes_selected_ids = $request->themes ? array_map('intval', $request->themes) : [];
        $categories_selected_ids = $request->categories ? array_map('intval', $request->categories) : [];

        // SEO
        SEOTools::setTitle('Acties' . ' | ' . config('brand.title'));

        return view('acties.agenda', compact('routes', 'themes', 'categories', 'themes_selected_ids', 'categories_selected_ids'));
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
        SEOTools::setTitle($actie->title . ' | ' . config('brand.title'));
        if ($actie->excerpt !== null) {
            SEOTools::setDescription($actie->excerpt);
        }
        if ($actie->keywords !== null) {
            SEOMeta::setKeywords($actie->keywords);
        }
        if ($actie->image_url !== null) {
            SEOTools::opengraph()->addImage($actie->image_url);
        }
        // set robots meta tag to noindex if the actie is over 1 year old
        if ($actie->start_date < now()->subYear()) {
            SEOMeta::setRobots('noindex');
        }

        // Pass admin attribute
        $isAdmin = false;
        if (auth()->user()) {
            $isAdmin = auth()->user()->hasRole('admin');
        }

        $themes = Theme::orderBy('name', 'ASC')->get();

        // count acties with the same theme
        $actieThemes = array_column($actie->themes->toArray(), 'id');
        $count_same_theme = Actie::query()
            ->whereHas('themes', function ($q) use ($actieThemes) {
                $q->whereIn('theme_id', $actieThemes);
            }) // where theme in $actieThemes
            ->whereNot('id', $actie->id) // exclude current action
            ->published()->nietAfgelopen()->count();

        return view('acties.actie', compact('actie', 'themes', 'routes', 'isAdmin', 'count_same_theme'));
    }

    public function search(Request $request)
    {
        $query = Actie::query();
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('body', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('keywords', 'LIKE', '%' . $request->q . '%');
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

        $query->published()->orderBy('start_date')->orderBy('start_time');

        if ($request->show_past === 'false') {
            $query->nietAfgelopen();
        }

        if ($request->limit) {
            $acties = $query->limit($request->limit)->get();
        } else {
            $acties = $query->paginate(24);
        }
        
        return response()->json(['acties' => $acties]);
    }
}
