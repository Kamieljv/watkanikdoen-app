<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Artesaos\SEOTools\Facades\SEOTools;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::active()->ordered()->get();

        SEOTools::setTitle('Links');
        SEOTools::setDescription(config('brand.description'));

        return view('links', compact('links'));
    }
}
