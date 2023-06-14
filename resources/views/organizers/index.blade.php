@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_home") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 px-5">
        <h1>{{__("organizers.title")}}</h1>
        <p class="mt-4">
            {!!__("organizers.sub_title")!!}
        </p>
    </div>

    <div class="max-w-6xl mx-auto mt-6 px-5">
        <div id="app">
            <organizers
                :routes="{{ $routes }}"
                :themes="{{ $themes }}"
            />
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