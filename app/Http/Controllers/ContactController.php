<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use App\Notifications\Mail\InboxMessageReceived;

class ContactController extends Controller
{
    /**
     * Store a submitted contact message.
     */
    public function store(StoreContactMessageRequest $request)
    {
        $message = ContactMessage::create($request->safe()->only(['name', 'email', 'subject', 'message']));

        $this->notifyAdmin(new InboxMessageReceived($message));

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'created',
            ], 201);
        }

        return redirect()
            ->to(url()->previous())
            ->with('success', __('contact.success'));
    }
}
