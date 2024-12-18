@extends('layouts.app')

@php
    $routes = [
        'login' => route('login'),
        'forgot_password' => route('password.request'),
        'register' => route('register'),
        'register_complete' => route('registration.complete'),
        'terms' => '/algemene-voorwaarden-en-privacyverklaring',
        'privacypolicy' => '/privacybeleid',
    ];
@endphp

@section('content')
    <div id="app">
        <login-register 
            :routes="{{ json_encode($routes) }}"
            :min-password-length="{{ config('app.auth.min_password_length') }}"
            h-captcha-key="{{ env('H_CAPTCHA_KEY') }}"
        />
    </div>
@endsection
