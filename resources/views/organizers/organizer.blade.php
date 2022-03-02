@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_acties") }}
        </a>
    </div>

    <div class="max-w-4xl mx-auto mt-6 px-5 lg:px-0">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="w-full md:w-auto flex flex-row items-center space-x-5">
                <div class="flex-shrink-0">
                    @if($organizer->linked_image)
                        <img class="w-[80px] h-[80px] rounded-full border-2 border-gray-300" src="{{ $organizer->linked_image->url }}" alt="">
                    @else
                        <div class="flex items-center justify-center text-4xl w-[80px] h-[80px]  rounded-full bg-gray-500 text-white border-gray-300">
                            {{ substr($organizer->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <h1>{{ $organizer->name }}</h1>
            </div>
            @if($organizer->website !== NULL)
                <a href="{{ $organizer->website }}" class="w-full md:w-auto inline-flex space-x-3 items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[color:var(--wkid-pink)] hover:bg-[color:var(--wkid-pink-dark)]">
                    @svg('antdesign-link-o', ['style' => 'width: 20px; height: 20px'])
                    <span>{{ __("general.go_to") . ' ' . $organizer->website_human }}</span>
                </a>
            @endif
        </div>
        <div class="mt-5 mb-10 min-h-20">
            @if ($organizer->description !== NULL)
                {!! filterScripts($organizer->description) !!}
            @endif
        </div>
        <div id="app">
            <h3 class="text-gray-800">Acties georganiseerd door {{ $organizer->name }}</h3>
            <actie-agenda
                :routes="{{ $routes }}"
                :filterable="false"
                :organizer-id="{{ $organizer->id }}"
                :narrower="true"
            >
            </actie-agenda>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="application/javascript">      
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush