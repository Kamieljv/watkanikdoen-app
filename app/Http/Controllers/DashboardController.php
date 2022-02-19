<?php

namespace App\Http\Controllers;

use App\Models\Aanmelding;
use App\Models\Actie;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use Validator;

use Voyager;

class DashboardController extends Controller
{
    /**
     * Displays the 'aanmeldingen' page for authenticated users
     */
    public function index()
    {
        // Haal aanmeldingen van deze gebruiker op
        $aanmeldingen = auth()->user()->aanmeldingen()->get();
        $notifications = auth()->user()->notifications()->get();
        return view('dashboard.index', compact('aanmeldingen', 'notifications'));
    }

    /**
     * Gets some statistics
     */
    public function getStats()
    {
        $acties = Actie::published()->count();
        $users = User::verified()->count();
        $organizers = Organizer::count();
        return response()->json([
            'acties' => $acties,
            'users' => $users,
            'organizers' => $organizers
        ]);
    }
}
