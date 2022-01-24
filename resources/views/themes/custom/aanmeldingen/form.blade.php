@extends('theme::layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_acties") }}
        </a>
    </div>
    <form role="form" method="POST" action="{{ route('aanmelding.create') }}">
        @csrf
        <div id="app" class="grid grid-cols-1 md:grid-cols-3 space-y-3 md:space-y-0 md:space-x-3 max-w-4xl mx-auto flex flex-col px-5 my-6 lg:px-0">
            <div class="col-span-2 space-y-3">
                <div class="flex flex-col justify-start flex-1 p-5 overflow-hidden bg-white border shadow-md rounded-lg border-gray-150">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Titel, tekst & afbeelding
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Omschrijf de actie zo goed als je kunt. Gebruik daarbij vooral ook teksten van de organisator, zolang je vermeldt waar deze vandaan komen.
                    </p>
                    <div class="flex flex-col mt-5 space-y-3">
                        {{-- Title --}}
                        <div>
                            <label for="title" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("aanmeldingen.title") }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="title" type="text" name="title" required class="w-full form-input" value="{{ old('title') }}" autofocus>
                            </div>
                            @if ($errors->has('title'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                        {{-- Body --}}
                        <div class="min-h-[200px]">
                            <label for="body" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("aanmeldingen.body") }}
                            </label>
                            <rich-text-field
                                name="body"
                                value="{{ old('body') }}"
                            />
                            @if ($errors->has('body'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('body') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-start flex-1 p-5 overflow-hidden bg-white border shadow-md rounded-lg border-gray-150">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Locatie
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Waar zal de actie plaatsvinden?
                    </p>
                    <div class="flex flex-col mt-5 space-y-3">
                        {{-- Location Human --}}
                        <div>
                            <label for="location_human" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("aanmeldingen.location_human") }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="location_human" type="text" name="location_human" required class="w-full form-input" value="{{ old('location_human') }}">
                            </div>
                            @if ($errors->has('location_human'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('location_human') }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("aanmeldingen.location") }}
                            </label>
                            @php
                                $defaultCenter = old('location') &&
                                    (old('location')['lat'] !== NULL)
                                        ? [old('location')]
                                        : [['lat' => config('voyager.maps.center.lat'), 'lng' => config('voyager.maps.center.lng')]];
                            @endphp
                            <div class="mt-1 rounded-md shadow-sm overflow-hidden">
                                <coordinates-form-field
                                    :default-center="{{ json_encode($defaultCenter) }}"
                                    :zoom={{ config('voyager.maps.zoom') }}
                                    fieldname="location"
                                />
                            </div>
                            @if ($errors->has('location'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-1 space-y-3">
                <div class="flex flex-col justify-start flex-1 p-5 overflow-hidden bg-white border shadow-md rounded-lg border-gray-150">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Organisator
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Wie organiseert deze actie?
                    </p>
                    <div class="flex flex-col mt-5 space-y-3">
                        {{-- Externe link --}}
                        <div>
                            <label for="externe_link" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("aanmeldingen.externe_link") }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="externe_link" type="url" name="externe_link" required class="w-full form-input" value="{{ old('externe_link') }}">
                            </div>
                            @if ($errors->has('externe_link'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('externe_link') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-start flex-1 mb-5 p-5 overflow-hidden bg-white border shadow-md rounded-lg border-gray-150">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Datum & tijd
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Wanneer begint en eindigt de actie?
                    </p>
                    <div class="flex flex-col mt-5 space-y-3">
                        {{-- Time start --}}
                        <div class="w-full">
                            <label for="time_start" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("aanmeldingen.time_start") }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input type="datetime-local" id="time_start" name="time_start" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" required class="w-full form-input" value="{{ old('time_start') }}">
                            </div>
                            @if ($errors->has('time_start'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('time_start') }}
                                </div>
                            @endif
                        </div>
                        {{-- Time end --}}
                        <div class="w-full">
                            <label for="time_end" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("aanmeldingen.time_end") }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input type="datetime-local" id="time_end" name="time_end" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" required class="w-full form-input" value="{{ old('time_end') }}">
                            </div>
                            @if ($errors->has('time_end'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('time_end') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center text-sm leading-5">
            <span class="block w-full mt-5 rounded-md shadow-sm">
                <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave active:bg-blue-700">
                    {{ __("general.send_form") }}
                </button>
            </span>
        </div>
    </form>
@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush
