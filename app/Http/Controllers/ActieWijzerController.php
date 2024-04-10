<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreDimensionRequest;
use App\Http\Requests\DeleteDimensionScoreRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Dimension;
use App\Models\ReferentieType;
use App\Models\Theme;
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
        if (key_exists('themes', $request->all())) {
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
        $referentie_types = ReferentieType::published()->get();
        // Calculate distance to calculate the percentage 
        $max_dist = sqrt(count($dimensions)*config('app.actiewijzer.max_score')**2);
        foreach ($referentie_types as $rt) {
            $rt->dist = euclidianDistance($rt->score_vector, array_column($dimensions->toArray(), 'score'));
            $rt->match_perc = round(($max_dist - $rt->dist) / $max_dist * 100);
        }
        $referentie_types = $referentie_types->sortBy('dist');

        return view('actiewijzer.result', compact('themes', 'dimensions', 'referentie_types', 'routes'));
    }
}
