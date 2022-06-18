@extends('layouts.app')

@php
    $routes = [
        'login' => route('login'),
        'password_reset' => route('password.email'),
    ];
@endphp

@section('content')
    <div id="app">
        <Forgot-Password
            :routes="{{ json_encode($routes) }}"
            csrf="{{ csrf_token() }}"
        />
    </div>
@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush
