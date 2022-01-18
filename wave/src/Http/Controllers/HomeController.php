<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Route;
use Wave\ActieTheme;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (setting('auth.dashboard_redirect') !== null) {
            if (!Auth::guest()) {
                return redirect('auth/dashboard');
            }
        }

        $seo = [
            'title'         => setting('site.title', 'WatKanIkDoen.nl'),
            'description'   => setting('site.description', 'Hét Startpunt voor Actief Burgerschap!'),
            'image'         => url('/og_image.png'),
            'type'          => 'website',
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

        $themes = ActieTheme::all();

        return view('theme::home', compact('seo', 'routes', 'themes'));
    }
}
