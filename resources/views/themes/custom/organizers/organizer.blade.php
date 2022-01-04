@extends('theme::layouts.app')

@section('content')

    <div class="max-w-4xl flex px-5 mx-auto mt-10 lg:px-0">
        <a href="{{ route('wave.home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_acties") }}
        </a>
    </div>
    
    <div class="max-w-4xl mx-auto mt-6 px-5 lg:px-0">
        <div class="flex flex-row gap-4 items-center">
            <div class="flex-shrink-0">
                <img class="w-[80px] h-[80px] rounded-full border-2 border-gray-300" src="{{ $organizer->logo_path }}" alt="">
            </div>
            <h1>{{ $organizer->name }}</h1>
        </div>
        <div class="mt-5">
            {!! $organizer->description !!}
        </div>
        <div>
            <h2>Acties georganiseerd door {{ $organizer->name }}</h2>
            <div id="app">
                <actie-agenda
                    :routes="{{ $routes }}"
                    :filterable="false"
                    :organizer-id="{{ $organizer->id }}"
                >
                </actie-agenda>
            </div>
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