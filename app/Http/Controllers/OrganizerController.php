<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Models\Organizer;

class OrganizerController extends VoyagerBaseController
{
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

        return view('theme::organizers.organizer', compact('organizer', 'seo', 'routes'));
    }
}
