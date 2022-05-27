@extends('layouts.app')

@php
    $routes = [
        'login' => route('login'),
        'forgot_password' => route('password.request'),
        'register' => route('register'),
    ];
@endphp

@section('content')
    <div id="app">
        <Login
            :routes="{{ json_encode($routes) }}"
            :errors="{{ $errors }}"
            remember="{{ old('remember') }}"
            :min-password-length="{{ config('app.auth.min_password_length') }}"
        >
            <template v-slot:csrf>
                {{ csrf_field() }}
            </template>
        </Login>
    </div>
@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush
