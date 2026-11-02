<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display the public feedback form.
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Store submitted feedback.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Feedback::create($validated);

        return redirect()
            ->to(url()->previous())
            ->with('success', 'Bedankt voor je feedback!');
    }

    /**
     * Display all feedback submissions (admin).
     */
    public function index()
    {
        $feedback = Feedback::latest()->paginate(15);

        return view('admin.feedback.index', compact('feedback'));
    }

    /**
     * Display an individual feedback submission (admin).
     */
    public function show(Feedback $feedback)
    {
        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Delete a feedback submission (admin).
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()
            ->route('admin.feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}
