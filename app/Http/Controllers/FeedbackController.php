<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Feedback;
use App\Notifications\Mail\InboxMessageReceived;
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
    public function store(StoreFeedbackRequest $request)
    {
        $message = Feedback::create($request->safe()->only(['name', 'email', 'subject', 'message']));

        $this->notifyAdmin(new InboxMessageReceived($message));

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'created',
            ], 201);
        }

        return redirect()
            ->to(url()->previous())
            ->with('success', __('feedback.success'));
    }
}
