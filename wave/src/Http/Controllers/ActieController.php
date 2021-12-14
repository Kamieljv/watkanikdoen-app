<?php

namespace Wave\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Wave\Actie;
use Wave\Category;


class ActieController extends \App\Http\Controllers\Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seo = [
            'title'         => setting('site.title', 'WatKanIkDoen.nl'),
            'description'   => setting('site.description', 'Hét Startpunt voor Actief Burgerschap!'),
            'image'         => url('/og_image.png'),
            'type'          => 'website'
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

        return view('theme::acties.index', compact('seo', 'routes'));
    }
    
    public function actie($slug){

    	$actie = Actie::where('slug', '=', $slug)->firstOrFail();

        $seo = [
            'seo_title' => $actie->title,
            'seo_description' => $actie->seo_description,
        ];

    	return view('theme::acties.actie', compact('actie', 'seo'));
    }

    public function search(Request $request) {
        $acties = Actie::search($request->get('q'))->paginate(12);

        $categories = Category::all();

        return response()->json(['acties' => $acties,
                                 'categories' => $categories]);
    }
}
