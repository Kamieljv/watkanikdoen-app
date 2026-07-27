@extends('layouts.app')

@section('content')
    <div id="app">
        <Newsletter
            :routes="{{ json_encode($routes) }}"
            h-captcha-key="{{ env('H_CAPTCHA_KEY') }}"
        />
    </div>
@endsection

