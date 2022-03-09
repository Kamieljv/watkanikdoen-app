@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_acties") }}
        </a>
    </div>

    <div class="max-w-4xl mx-auto mt-6 px-5 lg:px-0">
        <div class="max-w-4xl px-5 mx-auto prose prose-xl lg:px-0">
            <h2>Een actie toevoegen</h2>
            <p>Super dat je een actie wilt toevoegen! Op deze manier werk je met ons mee om de
                website volledig te maken.
                Om een actie toe te voegen vragen we je om in te loggen of een account aan te maken.
                Dit is nodig om je op de hoogte te houden van de status van de aangemelde actie.
            </p>
        </div>
    </div>

    <div class="mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white border shadow border-gray-50 sm:rounded-lg sm:px-10">
            <p class="mb-2 text-sm">{{ __("auth.no_account?") }}</p>
            <span class="block w-full rounded-md shadow-sm">
                <a href="{{ route('register') }}" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-blue-600 transition duration-150 ease-in-out border border-transparent rounded-md border-1 border-blue-600 hover:bg-blue-200">
                    {{ __("auth.register") }}
                </a>
            </span>
            <span class="block w-full mt-6 rounded-md shadow-sm">
                <a type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700">
                    {{ __("Log In") }}
                </a>
            </span>
        </div>
    </div>

@endsection