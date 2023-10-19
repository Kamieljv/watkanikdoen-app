@extends('layouts.app')

@php
    $routes = [
        'login' => route('login'),
        'forgot_password' => route('password.request'),
        'register' => route('register'),
        'terms' => '/algemene-voorwaarden-en-privacyverklaring',
        'privacypolicy' => '/privacybeleid',
    ];
@endphp

@section('content')
    <div id="app">
        <Register
            :routes="{{ json_encode($routes) }}"
            h-captcha-key="{{ env('H_CAPTCHA_KEY') }}"
            :min-password-length="{{ config('app.auth.min_password_length') }}"
            :errors="{{ $errors }}"
        >
            <template v-slot:csrf>
                {{ csrf_field() }}
            </template>
        </Register>
    </div>
@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush