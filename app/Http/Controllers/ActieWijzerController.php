<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Dimension;
use App\Models\Theme;
use Illuminate\Http\Request;

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

    public function scoreAnswerDimension() {
        //
    }

    public function result(Request $request) {

        $dimension_names = Dimension::all()->pluck('name')->toArray();
        $request_filtered = $request->only($dimension_names);

        $scores = array_filter($request_filtered, function($v) {
            return intval($v) && intval($v) >= config('app.actiewijzer.min_score') && intval($v) <= config('app.actiewijzer.max_score');
        });


        return view('actiewijzer.result', compact('scores'));
    }
}
