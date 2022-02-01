<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function page($slug)
    {
        $page = Page::where('slug', '=', $slug)
            ->where('status', '=', 'ACTIVE')->firstOrFail();

        $seo = [
            'seo_title' => $page->title,
            'seo_description' => $page->meta_description,
        ];

        return view('page', compact('page', 'seo'));
    }
}
