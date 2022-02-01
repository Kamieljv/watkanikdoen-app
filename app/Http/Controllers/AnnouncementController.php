<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::paginate(10);
        return view('announcements.index', compact('announcements'));
    }

    public function announcement($id)
    {
        $announcement = Announcement::find($id);
        return view('announcements.announcement', compact('announcement'));
    }

    public function read()
    {
        $user = auth()->user();
        $announcements = Announcement::all();
        foreach ($announcements as $announcement) {
            if (!$user->announcements()->where('id', $announcement->id)->exists()) {
                $user->announcements()->attach($announcement->id);
            }
        }
    }
}
