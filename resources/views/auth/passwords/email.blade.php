@extends('layouts.app')

@php
    $routes = [
        'login' => route('login'),
        'password_reset' => route('password.email'),
    ];
@endphp

@section('content')
    <div id="app">
        <forgot-password
            :routes="{{ json_encode($routes) }}"
            csrf="{{ csrf_token() }}"
        />
    </div>
@endsection
