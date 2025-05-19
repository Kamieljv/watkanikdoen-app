@extends('layouts.app')

@section('content')
    <div class="px-3 xl:px-5">
        <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
            <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                {{ __("acties.back_to_home") }}
            </a>
        </div>

        {{-- ActieWijzer banner --}}
        <div id="actiewijzer-banner-container" class="relative mt-5 md:mx-auto max-w-6xl">
            <div id="actiewijzer-banner" class="text-white p-4 md:px-6 rounded-lg flex flex-col md:flex-row justify-between items-end md:items-center gap-2 md:gap-0">
                <p class="text-base md:text-xl w-full md:w-auto"><span class="font-bold">Nieuw!</span>&nbsp; {!! __('actiewijzer.promo_text') !!}</p>
                <a href="/actiewijzer">
                    <button class="secondary-white flex items-center hover:translate-x-[0.250rem]">
                        <p class="text-lg">{{__('actiewijzer.start')}}</p>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 ml-1" style="transform: rotate(180deg);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </button>
                </a>
            </div>
        </div>

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