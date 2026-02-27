@extends('layouts.app')

@section('content')
    <div id="app">
        <login-register 
            :routes="{{ json_encode($routes) }}"
            :min-password-length="{{ config('app.auth.min_password_length') }}"
            h-captcha-key="{{ env('H_CAPTCHA_KEY') }}"
            type="{{ $type ?? 'login' }}"
        />
    </div>
@endsection
