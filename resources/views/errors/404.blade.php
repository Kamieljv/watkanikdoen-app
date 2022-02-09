@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_acties") }}
        </a>
    </div>

    <div class="max-w-4xl mx-auto mt-6 px-5 lg:px-0">
        {{-- Bottom --}}
        <div class="w-full relative flex justify-center">
            <span class="font-bold text-gray-200" style="font-size: 200px">404</span>
            {{-- Top --}}
            <div class="w-full absolute inset-0 flex justify-center items-center">
                <h1>{{ __("general.404_header") }}</h1>
            </div>
        </div>
    </div>
@endsection