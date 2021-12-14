<?php

namespace Wave\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Wave\Actie;
use Wave\Category;


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

    public function acties(Request $request) {
        $acties = Actie::search($request->get('q'))->paginate(12);

        $categories = Category::all();

        return response()->json(['acties' => $acties,
                                 'categories' => $categories]);
    }
}
