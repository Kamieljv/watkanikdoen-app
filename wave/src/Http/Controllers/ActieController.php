<?php

namespace Wave\Http\Controllers;

use Algolia\AlgoliaSearch\SearchIndex;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
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

    public function search(Request $request) {
        $acties = Actie::search($request->get('q'), function (SearchIndex $algolia, string $query, array $options) use ($request) {
            $options['facetFilters'] = [preg_filter('/^/', 'themes.id:', $request->get('themes'))];
            $options['aroundLatLng'] = $request->get('coordinates') ?? '';
            $options['aroundRadius'] = ($request->get('distance') ?? 9999) * 1000;
            $options['filters'] = "start_unix > ". time();
            return $algolia->search($query, $options);
        })
            ->within('acties_start_unix_asc')
            ->paginate(12);

        return response()->json(['acties' => $acties]);
    }
}
