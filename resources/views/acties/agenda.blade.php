@extends('layouts.app')

@section('content')
    <div class="px-3 xl:px-5">
        <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
            <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
                @svg('custom-arrow-left', 'w-4 h-4 mr-2')
                {{ __("general.back_to_home") }}
            </a>
        </div>

        <div class="max-w-6xl mx-auto mt-6">
            <h1>{{__("acties.title")}}</h1>
            <p class="mt-4">
                {!!__("acties.sub_title")!!}
            </p>
        </div>
    </div>
    <div id="app" class="px-3 xl:px-5 mb-40">
        <actie-agenda :routes="{{ json_encode($routes) }}" :themes="{{ $themes }}" :categories="{{ $categories }}"
            :themes-selected-ids="{{ json_encode($themes_selected_ids) }}"
            :categories-selected-ids="{{ json_encode($categories_selected_ids) }}">
        </actie-agenda>
    </div>
@endsection