<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use App\Events\SubscriberVerified;
use App\Models\Subscriber;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\DeleteSubscriberRequest;
use App\Http\Requests\VerifySubscriberRequest;
use App\Exceptions\SubscriberVerificationException;

class SubscriberController extends Controller
{
    public function landing()
    {
        return view('newsletter.landing');
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

    public function delete(DeleteSubscriberRequest $request)
    {
        $request->subscriber()->delete();
        return view('subscribe.deleted');
    }

    public function verify(VerifySubscriberRequest $request)
    {
        $subscriber = Subscriber::find($request->id);
        if (!hash_equals((string) $request->route('id'), (string) $subscriber->getKey())) {
            throw new SubscriberVerificationException;
        }

        if (!hash_equals((string) $request->route('hash'), sha1($subscriber->getEmailForVerification()))) {
            throw new SubscriberVerificationException;
        }

        if ($subscriber->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new Response('', 204)
                : redirect()->route(config('newsletter.redirect_url'));
        }

        $subscriber->markEmailAsVerified();

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route(config('newsletter.redirect_url'))->with('verified', __('You are successfully subscribed to our list!'));
    }
}