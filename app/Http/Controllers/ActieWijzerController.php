<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Dimension;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActieWijzerController extends Controller
{
    /**
     * Displays the 'landing' page for unauthenticated users
     */
    public function landing()
    {
        $questions = Question::active()->get()->toArray();
        $dimensions = Dimension::all()->toArray();
        $result_route = route('actiewijzer.result');

        // Display the landing page
        return view('actiewijzer.landing', compact('questions', 'dimensions', 'result_route'));
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
}
