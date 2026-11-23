@extends('layouts.app')

@section('content')
    <div id="app">
        <Feedback :routes="{{ json_encode(['store' => route('feedback.store')]) }}"
            h-captcha-key="{{ env('H_CAPTCHA_KEY') }}" />
    </div>
@endsection