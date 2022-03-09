<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\SearchIndex;
use App\Models\Actie;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class ActieController extends VoyagerBaseController
{
    public function actie($slug)
    {

        $actie = Actie::where('slug', '=', $slug)->firstOrFail();

        if (!$actie->published) {
            abort(404);
        }

        // SEO
        SEOTools::setTitle($actie->title);
        if ($actie->excerpt !== null) {
            SEOTools::setDescription($actie->excerpt);
        }
        if ($actie->keywords !== null) {
            SEOMeta::setKeywords($actie->keywords);
        }

        return view('acties.actie', compact('actie'));
    }

    public function search(Request $request)
    {
        $acties = Actie::search($request->q, function (SearchIndex $algolia, string $query, array $options) use ($request) {
            // Filters for themes and organizers (facets)
            $options['facetFilters'] = [
                preg_filter('/^/', 'themes.id:', $request->themes), // theme filters
                ['organizers.id:' . $request->organizer], // organization filter
            ];
            // Fitlers for coordinates with radius
            $options['aroundLatLng'] = $request->coordinates ?? '';
            $options['aroundRadius'] = ($request->distance ?? 9999) * 1000;

            // Filter for showing past actions
            if ($request->show_past === 'false') {
                $options['filters'] = "start_unix > " . time();
            }

            return $algolia->search($query, $options);
        })
            ->within('acties_start_unix_asc')
            ->paginate(12);

        return response()->json(['acties' => $acties]);
    }
}
