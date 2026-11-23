@extends('layouts.app')

@section('content')
    <div id="app">
        <message-form
            type="feedback"
            :routes="{{ json_encode(['store' => route('feedback.store')]) }}"
            h-captcha-key="{{ env('H_CAPTCHA_KEY') }}"
        />
    </div>
@endsection
