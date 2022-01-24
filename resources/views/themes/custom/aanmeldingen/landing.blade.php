@extends('theme::layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_acties") }}
        </a>
    </div>

    <div class="max-w-4xl mx-auto mt-6 px-5 lg:px-0">
        <div class="max-w-4xl px-5 mx-auto prose prose-xl lg:px-0">

            <h2 class="uppercase">Een actie toevoegen</h2>

            <p>Hier kun je gemakkelijk een actie toevoegen.</p>

            <div class="flex justify-center mt-5">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-500 hover:bg-blue-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-wave active:bg-blue-700">
                    {{__("Log In")}}
                </a>
            </div>
            <p class="mt-4 text-sm leading-5 text-center text-gray-600 max-w">
                {{ __("general.or") }}
                <a href="{{ route('register') }}" class="font-medium transition duration-150 ease-in-out text-[color:var(--wkid-blue)] focus:outline-none hover:underline hover:text-[color:var(--wkid-blue-dark)]">
                    {{ __("auth.register") }}
                </a>
            </p>
        </div>
    </div>

@endsection