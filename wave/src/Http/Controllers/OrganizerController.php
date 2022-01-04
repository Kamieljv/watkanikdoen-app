<?php

namespace Wave\Http\Controllers;

use Algolia\AlgoliaSearch\SearchIndex;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Wave\Organizer;
use Wave\Actie;


class OrganizerController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    
    public function organizer($slug){

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
