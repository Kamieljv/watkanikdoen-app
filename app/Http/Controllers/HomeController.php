<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
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

        // SEO
        SEOTools::setTitle('Home');

        return view('home', compact('routes', 'themes'));
    }
}
