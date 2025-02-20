<?php

namespace App\Http\Controllers;

use App\Models\HandbookPage;
use App\Models\Tag;

class HandbookController extends Controller
{
    public function index()
    {
        $rootPages = HandbookPage::whereNull('parent_id')
            ->orderBy('order')
            ->with(['children', 'tags'])
            ->get();

        return view('handbook.index', compact('rootPages'));
    }

    public function page($slug)
    {
        $page = HandbookPage::where('slug', $slug)
            ->with(['children', 'tags'])
            ->firstOrFail();

        return view('handbook.show', compact('page'));
    }
}
