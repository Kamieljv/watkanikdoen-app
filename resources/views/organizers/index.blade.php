@extends('layouts.app')

@section('content')
    <div class="px-3 xl:px-5">
        <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
            <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
                @svg('custom-arrow-left', 'w-4 h-4 mr-2')
                {{ __("general.back_to_home") }}
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
        <organizers :routes="{{ json_encode($routes) }}" :themes="{{ $themes }}" />
    </div>

@endsection