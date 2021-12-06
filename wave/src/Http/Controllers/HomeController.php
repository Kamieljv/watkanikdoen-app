<?php

namespace Wave\Http\Controllers;

use Illuminate\Http\Request;
use Wave\Actie;
use Wave\Category;

class HomeController extends \App\Http\Controllers\Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if(setting('auth.dashboard_redirect', true) != "null"){
    		if(!\Auth::guest()){
    			return redirect('dashboard');
    		}
    	}

        $acties = Actie::orderBy('created_at', 'DESC')->paginate(12);
        $categories = Category::all();

        $seo = [

            'title'         => setting('site.title', 'WatKanIkDoen.nl'),
            'description'   => setting('site.description', 'Hét Startpunt voor Actief Burgerschap!'),
            'image'         => url('/og_image.png'),
            'type'          => 'website'
        ];

        return view('theme::acties.index', compact('acties', 'categories', 'seo'));
    }
}
