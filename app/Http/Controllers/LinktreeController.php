<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Artesaos\SEOTools\Facades\SEOTools;

class LinktreeController extends Controller
{
    public function index()
    {
        $links = Link::active()->ordered()->get();

        SEOTools::setTitle(config('brand.title'));
        SEOTools::setDescription(config('brand.description'));

        return view('linktree', compact('links'));
    }
}
