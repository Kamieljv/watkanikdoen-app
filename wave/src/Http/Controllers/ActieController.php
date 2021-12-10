<?php

namespace Wave\Http\Controllers;

use Illuminate\Http\Request;
use Wave\Actie;
use Wave\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ActieController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function actie($slug){

    	$actie = Actie::where('slug', '=', $slug)->firstOrFail();

        $seo = [
            'seo_title' => $actie->title,
            'seo_description' => $actie->seo_description,
        ];

    	return view('theme::acties.actie', compact('actie', 'seo'));
    }

    public function acties() {
        $acties = Actie::with('categories')->first()->toArray();//->orderBy('created_at', 'DESC')->paginate(12);
        Log::debug($acties);
        $categories = Category::all();

        return response()->json(['acties' => $acties,
                                 'categories' => $categories]);
    }
}
