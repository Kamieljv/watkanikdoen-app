<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;

class MapController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Kaart | ' . config('brand.title'));

        return view('map');
    }
}
