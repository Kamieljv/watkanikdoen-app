<?php

namespace Wave\Http\Controllers;

use Illuminate\Http\Request;
use Wave\Event;
use Wave\Category;

class EventController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function actie($slug){

    	$actie = Event::where('slug', '=', $slug)->firstOrFail();

        $seo = [
            'seo_title' => $actie->title,
            'seo_description' => $actie->seo_description,
        ];

    	return view('theme::acties.actie', compact('actie', 'seo'));
    }
}
