<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreDimensionRequest;
use App\Http\Requests\DeleteDimensionScoreRequest;
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
        $themes = Theme::all()->toArray();
        $result_route = route('actiewijzer.result');

        // SEO
        SEOTools::setTitle(__('actiewijzer.title'));
        SEOTools::setDescription(__('actiewijzer.description'));
        SEOMeta::setKeywords(__('actiewijzer.keywords'));

        // Display the landing page
        return view('actiewijzer.landing', compact('questions', 'dimensions', 'themes', 'result_route'));
    }

    public function scoreDimension(ScoreDimensionRequest $request) {
        /**
         * Attach a dimension to an entity (e.g. an answer) and set the score
         * @param ScoreDimensionRequest $request (containing entity_class, entity_id, dimension_id)
         */

        try {
            // get the correct model class
            $class = $request->entity_class;
            $entityClass = new $class();

            // find the model instance using the entity_id
            $entity = $entityClass::find($request->entity_id);

            $updateScore = $entity->dimensions()
                ->updateExistingPivot($request->dimension_id, ['score' => $request->score]);
            if ($updateScore === 0) {
                // create relationship and set score if it does not exist yet
                $updateScore = $entity->dimensions()
                    ->attach($request->dimension_id, ['score' => $request->score]);
            }

            return response(['status' => 'success', 'message' => 'Score updated'], 200);
        } catch (Exception $e) {
            return response(['status' => 'failed', 'message' => 'Something went wrong'], 400);
        }
    }

    public function deleteDimensionScore(DeleteDimensionScoreRequest $request) {
        /**
         * Detach a dimension from an answer
         * @param DeleteDimensionScoreRequest $request (containing entity_classs, entity_id, dimension_id)
         */

        try {
            // get the correct model class
            $class = $request->entity_class;
            $entityClass = new $class();

            // find the model instance using the entity_id
            $entity = $entityClass::find($request->entity_id);
            $entity->dimensions()->detach($request->dimension_id);
            return response(['status' => 'success', 'message' => 'Score deleted'], 200);
        } catch (Exception $e) {
            return response(['status' => 'failed', 'message' => 'Something went wrong'], 400);
        }
        $answer = Answer::find($request->answer_id)->dimensions()->detach($request->dimension_id);
    }

    public function editAnswer(Request $request) {
        try {
            $answer = Answer::find($request->id);
            $answer->answer = $request->answer;
            $answer->save();
            return response(['status' => 'success', 'message' => 'Answer updated'], 200);
        } catch (Exception $e) {
            return response(['status' => 'failed', 'message' => 'Something went wrong'], 400);
        }
    }

    public function result(Request $request) {

        $dimensions = Dimension::all();

        // Filter the request parameters using the dimension names and min/max score settings
        $requests_filtered = array_filter($request->only($dimensions->pluck('name')->toArray()), function($v) {
            return intval($v) && intval($v) >= config('app.actiewijzer.min_score') && intval($v) <= config('app.actiewijzer.max_score');
        });

        foreach ($dimensions as $d) {
            $d->score = isset($requests_filtered[$d->name]) ? $requests_filtered[$d->name] : 0;
        }

        $themes = null;
        if ( key_exists('themes', $request->all())) {
            $themes = Theme::whereIn('id', $request['themes'])->get();
        }

        // Definieer de routes waarmee de component evenementen kan ophalen
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
                $query->whereIn('theme_id', $themes->pluck('id')->toArray());
            });
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
                $rt->referenties = ReferentieType::find($rt->id)->referenties()->inRandomOrder()->limit(3)->get();
            }
        }
        $referentie_types = $referentie_types->sortByDesc('match_perc');

        return view('actiewijzer.result', compact('themes', 'dimensions', 'referentie_types', 'routes'));
    }

    public function referentie_type($referentie_type, Request $request)
    {
        $referentie_type = ReferentieType::where('title', $referentie_type)->firstOrFail();

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

        $query = Referentie::query()->whereHas('referentie_types', function($q) use ($referentie_type) {
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
            $referenties = $query->orderBy('title', 'ASC')->published()->paginate(12);
        }

        return response()->json(['referenties' => $referenties]);
    }
}
