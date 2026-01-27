<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreDimensionRequest;
use App\Http\Requests\DeleteDimensionScoreRequest;
use App\Models\Actie;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Dimension;
use App\Models\Referentie;
use App\Models\ReferentieType;
use App\Models\Theme;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ActieWijzerController extends Controller
{
    /**
     * Displays the 'landing' page for unauthenticated users
     */
    public function landing()
    {
        $questions = Question::active()->get()->toArray();
        $dimensions = Dimension::all()->toArray();
        $themes = Theme::orderBy('name', 'ASC')->get()->toArray();
        $result_route = route('actiewijzer.result');

        // SEO
        SEOTools::setTitle(__('actiewijzer.title') . ' | ' . config('brand.title'));
        SEOTools::setDescription(__('actiewijzer.description'));
        SEOMeta::setKeywords(__('actiewijzer.keywords'));

        // Display the landing page
        return view('actiewijzer.landing', compact('questions', 'dimensions', 'themes', 'result_route'));
    }

    public function result(Request $request) {

        $dimensions = Dimension::all();

        // Filter the request parameters using the dimension names and min/max score settings
        // Only keep the dimensions with a score between the min and max score
        $requests_filtered = array_filter($request->only($dimensions->pluck('name')->toArray()), function($v) {
            return intval($v) && intval($v) >= config('app.actiewijzer.min_score') && intval($v) <= config('app.actiewijzer.max_score');
        });

        // Set the score of the dimensions
        foreach ($dimensions as $d) {
            $d->score = isset($requests_filtered[$d->name]) ? $requests_filtered[$d->name] : 0;
        }

        // Construct a set of themes that are selected
        $themes = collect();
        if ( key_exists('themes', $request->all())) {
            $themes = Theme::whereIn('id', $request['themes'])->get();
        }

        // Define the routes with which the component can get the referenties/acties
        $routes = collect(Route::getRoutes()->getRoutesByName())->filter(function ($route) {
            return (strpos($route->uri, 'acties') !== false) && (strpos($route->uri, 'admin') === false);
        })->map(function ($route) {
            return [
                'uri' => '/' . $route->uri,
                'methods' => $route->methods,
            ];
        });

        // Get referentie_types and calculate the similarity with the score_vector
        $referentie_types = ReferentieType::published()->with(['referenties' => function (Builder $query) use ($themes) {
            $query->whereHas('themes', function (Builder $query) use ($themes) {
                if ($themes->count() > 0) {
                    $query->whereIn('theme_id', $themes->pluck('id')->toArray());
                }
            })->with('referentie_types');
            $query->inRandomOrder()->limit(3);
        }])->get();

        foreach ($referentie_types as $rt) {
            // calculate percentage match 
            $dims_filtered = array_filter($dimensions->toArray(), function($d) use ($rt) {
                return in_array($d['id'], array_keys($rt->score_vector));
            });
            $dim_scores = array_combine(array_column($dims_filtered, 'id'), array_column($dims_filtered, 'score'));
            $rt->match_perc = round(percentageMatch($dim_scores, $rt->score_vector));

            // if we get 0 referenties, get 3 referenties without filtering by theme
            if ($rt->referenties->count() == 0) {
                $rt->referenties = ReferentieType::find($rt->id)->referenties()->with('referentie_types')->inRandomOrder()->limit(3)->get();
            }
        }
        $referentie_types = $referentie_types->sortByDesc('match_perc');

        // Check if there are published and future actions in the selected themes
        $has_relevant_acties = Actie::whereHas('themes', function (Builder $query) use ($themes) {
            if ($themes->count() > 0) {
                $query->whereIn('theme_id', $themes->pluck('id')->toArray());
            }
        })->published()->nietAfgelopen()->exists();

        return view('actiewijzer.result', compact('themes', 'dimensions', 'referentie_types', 'routes', 'has_relevant_acties'));
    }

    public function referentie_type($slug, Request $request)
    {
        $referentie_type = ReferentieType::where('slug', $slug)->firstOrFail();

        // Definieer de routes waarmee de component evenementen kan ophalen
        $routes = collect(Route::getRoutes()->getRoutesByName())->filter(function ($route) {
            return strpos($route->uri, 'referenties') !== false && (strpos($route->uri, 'admin') === false);
        })->map(function ($route) {
            return [
                'uri' => '/' . $route->uri,
                'methods' => $route->methods,
            ];
        });

        $themes = Theme::orderBy('name', 'ASC')->get();
        $themes_selected_ids = $request->themes ? array_map('intval', $request->themes) : [];

        // SEO
        SEOTools::setTitle($referentie_type->title);
        SEOTools::setDescription($referentie_type->description);
        SEOMeta::setKeywords($referentie_type->title);

        return view('actiewijzer.referentie_type', compact('referentie_type', 'themes', 'routes', 'themes_selected_ids'));
    }

    public function search(Request $request)
    {
        $referentie_type = ReferentieType::find($request->referentieTypeId);

        $query = Referentie::query()->with('referentie_types')->whereHas('referentie_types', function($q) use ($referentie_type) {
            $q->where('referentie_type_id', $referentie_type->id);
        });
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->q . '%');
            });
        }
        if ($request->themes) {
            $requestThemes = $request->themes;
            $query->whereHas('themes', function ($q) use ($requestThemes) {
                $q->whereIn('theme_id', $requestThemes);
            });
        }
        if ($request->limit) {
            $referenties = $query->orderBy('title', 'ASC')->published()->limit($request->limit)->get();
        } else {
            $referenties = $query->orderBy('title', 'ASC')->published()->paginate(24);
        }

        return response()->json(['referenties' => $referenties]);
    }
}
