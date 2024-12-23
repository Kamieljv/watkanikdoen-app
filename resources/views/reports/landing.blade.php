@extends('layouts.app')

@php
    $routes = array_merge($routes, [
        'report_create' => route('report.create'),
        'login' => route('login'),
        'register' => route('register'),
    ]);
    $defaultCenter = old('location') &&
        (old('location')['lat'] !== NULL)
            ? [old('location')]
            : [['lat' => config('voyager.maps.center.lat'), 'lng' => config('voyager.maps.center.lng')]];
@endphp

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_home") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 mb-40 px-5 lg:px-0">
        <div id="app">
            <Add-Actie
                :routes="{{ json_encode($routes) }}"
                :default-center="{{ json_encode($defaultCenter) }}"
                :zoom={{ config('voyager.maps.zoom') }}
                :min-password-length="{{ config('app.auth.min_password_length') }}"
                h-captcha-key="{{ env('H_CAPTCHA_KEY') }}"
                :user="{{ auth()->user() ? auth()->user() : '{}' }}"
            >
            </Add-Actie>
        </div>
    </div>

@endsection