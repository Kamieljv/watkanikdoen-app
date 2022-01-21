<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\SearchIndex;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Models\Actie;

class ActieController extends VoyagerBaseController
{
    public function actie($slug)
    {

        $actie = Actie::where('slug', '=', $slug)->firstOrFail();

        $seo = [
            'seo_title' => $actie->title,
            'seo_description' => $actie->seo_description,
        ];

        return view('theme::acties.actie', compact('actie', 'seo'));
    }

    public function search(Request $request)
    {
        $acties = Actie::search($request->get('q'), function (SearchIndex $algolia, string $query, array $options) use ($request) {
            $options['facetFilters'] = [
                preg_filter('/^/', 'themes.id:', $request->get('themes')), // theme filters
                ['organizers.id:' . $request->get('organizer')], // organization filter
            ];
            $options['aroundLatLng'] = $request->get('coordinates') ?? '';
            $options['aroundRadius'] = ($request->get('distance') ?? 9999) * 1000;
            $options['filters'] = "start_unix > " . time();
            return $algolia->search($query, $options);
        })
            ->within('acties_start_unix_asc')
            ->paginate(12);

        return response()->json(['acties' => $acties]);
    }
}
