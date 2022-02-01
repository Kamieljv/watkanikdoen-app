<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Organizer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class OrganizerController extends Controller
{
    public function index()
    {
        // Definieer de routes waarmee de component evenementen kan ophalen
        $routes = collect(Route::getRoutes()->getRoutesByName())->filter(function ($route) {
            return (strpos($route->uri, 'organizers') !== false || strpos($route->uri, 'organizer') !== false) && (strpos($route->uri, 'admin') === false);
        })->map(function ($route) {
            return [
                'uri' => '/' . $route->uri,
                'methods' => $route->methods,
            ];
        });

        $themes = Theme::all();

        return view('organizers.index', compact('routes', 'themes'));
    }

    public function search(Request $request)
    {
        $organizers = new Organizer();
        if ($request->q) {
            $organizers = $organizers->where('name', 'LIKE', '%'.$request->q.'%')
                            ->orWhere('description', 'LIKE', '%'.$request->q.'%');
        }
        if ($request->themes) {
            $organizers = $organizers->whereHas('themes', function (Builder $query) use ($request) {
                $query->where('theme_id', '=', $request->themes[0]);
                foreach (array_splice($request->themes, 1) as $key => $theme_id) {
                    $query->orWhere('theme_id', '=', $theme_id);
                }
            });
        }
        $organizers = $organizers->paginate(12);

        return response()->json(['organizers' => $organizers]);
    }

    public function organizer($slug)
    {

        $organizer = Organizer::where('slug', '=', $slug)->firstOrFail();

        $seo = [
            'seo_title' => $organizer->name,
            'seo_description' => $organizer->description,
        ];

        // Definieer de routes waarmee de component evenementen kan ophalen
        $routes = collect(Route::getRoutes()->getRoutesByName())->filter(function ($route) {
            return (strpos($route->uri, 'acties') !== false) && (strpos($route->uri, 'admin') === false);
        })->map(function ($route) {
            return [
                'uri' => '/' . $route->uri,
                'methods' => $route->methods,
            ];
        });

        return view('organizers.organizer', compact('organizer', 'seo', 'routes'));
    }
}
