<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use App\Models\Organizer;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Displays the 'reports' page for authenticated users
     */
    public function index()
    {
        // Haal reports van deze gebruiker op
        $reports = auth()->user()->reports()->get();
        $notifications = auth()->user()->notifications()->get();
        return view('dashboard.index', compact('reports', 'notifications'));
    }

    /**
     * Gets statistics
     */
    public function getStats()
    {
        $acties = Actie::published()->count();
        $users = User::verified()->count();
        $organizers = Organizer::count();
        return response()->json([
            'acties' => $acties,
            'users' => $users,
            'organizers' => $organizers,
        ]);
    }
}
