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
        >
            <template v-slot:csrf>
                {{ csrf_field() }}
            </template>
        </Newsletter>
    </div>
@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush

