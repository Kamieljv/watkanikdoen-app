@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            @svg('custom-arrow-left', 'w-4 h-4 mr-2')
            {{ __("general.back_to_home") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 px-5 lg:px-0">
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