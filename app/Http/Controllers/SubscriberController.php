<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Subscriber;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\VerifySubscriberRequest;
use Validator;

class SubscriberController extends Controller
{
    public function landing()
    {
        return view('newsletter.landing');
    }

    public function verified()
    {
        if (!(session()->has('error') || session()->has('success'))) {
            return redirect()->route('home');
        }
        return view('newsletter.verified');
    }

    public function store(StoreSubscriberRequest $request)
    {
        $subscriber = Subscriber::create($request->all());

        if (config('newsletter.verify')) {
            $subscriber->sendEmailVerificationNotification();
        }

        return response()->json([
            'status' => 'created',
        ], 201);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect('/')->with('error', __("newsletter.unsubscribe_error"));
        }
        
        try {
            $subscriber = Subscriber::where('email', $request->email)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return redirect('/')->with('error', __("newsletter.unsubscribe_error"));
        }
        
        $subscriber->delete();
        return view('newsletter.unsubscribed');
    }

    public function verify(VerifySubscriberRequest $request)
    {
        $subscriber = Subscriber::find($request->id);
        if (!hash_equals((string) $request->route('id'), (string) $subscriber->getKey()) || 
            !hash_equals((string) $request->route('hash'), sha1($subscriber->getEmailForVerification()))
        ) {
            return redirect()->route('subscribers.verified')->with('error', __('newsletter.verified_error'));
        }

        if (!$subscriber->hasVerifiedEmail()) {
            $subscriber->markEmailAsVerified();
        }

        return redirect()->route('subscribers.verified')->with('success', __('newsletter.verified_success'));
    }
}