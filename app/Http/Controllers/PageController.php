<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Artesaos\SEOTools\Facades\SEOTools;

class PageController extends Controller
{
    public function page($slug)
    {
        $page = Page::published()->where('slug', '=', $slug)->firstOrFail();

        // SEO
        SEOTools::setTitle($page->title . ' | ' . config('brand.title'));
        if ($page->meta_description !== null) {
            SEOTools::setDescription(substr(strip_tags($page->meta_description), 0, 300));
        }

        return view('page', compact('page'));
    }
}
