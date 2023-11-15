<?php

namespace App\Http\Controllers;

use App\Models\Question;

class ActieWijzerController extends Controller
{
    /**
     * Displays the 'landing' page for unauthenticated users
     */
    public function landing()
    {
        $questions = Question::active()->get()->toArray();

        // Display the landing page
        return view('actiewijzer.landing', compact('questions'));
    }
}
