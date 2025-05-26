@extends('layouts.app')

@section('content')
    <div class="px-3 xl:px-5">
        <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
            <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                {{ __("acties.back_to_home") }}
            </a>
        </div>

        @include('partials.actiewijzer-banner')

        <div class="max-w-6xl mx-auto mt-6">
            <h1>{{__("organizers.title")}}</h1>
            <p class="mt-4">
                {!!__("organizers.sub_title")!!}
            </p>
        </div>
    </div>

    <div id="app" class="max-w-6xl mb-40 mx-auto mt-6 px-3">
        <organizers
            :routes="{{ $routes }}"
            :themes="{{ $themes }}"
        />
    </div>

@endsection