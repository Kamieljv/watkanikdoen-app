<?php

namespace Wave\Http\Controllers;

use Illuminate\Http\Request;
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
}
