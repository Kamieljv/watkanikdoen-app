<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Dimension;
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

    public function scoreAnswerDimension(Request $request) {
        // The request should contain an answer_id, dimension_id and a score
        $answer = Answer::find($request->answer_id);
        $updateScore = $answer->dimensions()
            ->updateExistingPivot($request->dimension_id, ['score' => $request->score]);
        if ($updateScore === 0) {
            // create relationship and set score if it does not exist yet
            $updateScore = $answer->dimensions()
                ->attach($request->dimension_id, ['score' => $request->score]);
        }
    }

    public function deleteAnswerDimension(Request $request) {
        // The request should contain an answer_id, dimension_id and a score
        $answer = Answer::find($request->answer_id)->dimensions()->detach($request->dimension_id);
    }

    public function result(Request $request) {

        // Get dimension names to define what URL parameters are allowed
        $dimension_names = Dimension::all()->pluck('name')->toArray();
        $request_filtered = $request->only($dimension_names);

        $scores = array_filter($request_filtered, function($v) {
            return intval($v) && intval($v) >= config('app.actiewijzer.min_score') && intval($v) <= config('app.actiewijzer.max_score');
        });

        if (key_exists('themes', $request->all())) {
            $scores['themes'] = Theme::whereIn('id', $request['themes'])->get();
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

        return view('actiewijzer.result', compact('scores', 'routes'));
    }
}
