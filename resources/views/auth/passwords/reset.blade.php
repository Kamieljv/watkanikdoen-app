@extends('layouts.app')

@php
    $routes = [
        'login' => route('login'),
        'password_change' => route('password.request'),
    ];
@endphp

@section('content')
    <div id="app">
        <Reset-Password
            :routes="{{ json_encode($routes) }}"
            token="{{ $token }}"
            :min-password-length="{{ config('app.auth.min_password_length') }}"
        >
            <template v-slot:csrf>
                {{ csrf_field() }}
            </template>
        </Reset-Password>
    </div>
@endsection