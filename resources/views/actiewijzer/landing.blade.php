@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            @svg('custom-arrow-left', 'w-4 h-4 mr-2')
            {{ __("acties.back_to_home") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 mb-40 px-5 lg:px-0">
        <div id="app">
            <Actie-Wijzer
                :questions="{{ json_encode($questions) }}"
                :dimensions="{{ json_encode($dimensions) }}"
                :themes="{{ json_encode($themes) }}"
                :result-route="'{{ $result_route }}'"
            >
        </div>
    </div>

@endsection
