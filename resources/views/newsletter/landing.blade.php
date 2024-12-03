@extends('layouts.app')

@php
    $routes = [
        'subscribe' => route('subscribers.store'),
        'terms' => '/algemene-voorwaarden-en-privacyverklaring',
    ];
@endphp

@section('content')
    <div id="app">
        <Newsletter
            :routes="{{ json_encode($routes) }}"
            h-captcha-key="{{ env('H_CAPTCHA_KEY') }}"
        />
    </div>
@endsection

