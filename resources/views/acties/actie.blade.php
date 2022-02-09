@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_acties") }}
        </a>
    </div>
    <article id="post-{{ $actie->id }}" class="max-w-4xl px-5 mb-4 mx-auto prose lg:px-0 mt-6">
        <meta property="name" content="{{ $actie->title }}">
        <meta property="author" typeof="Person" content="admin">
        <meta property="dateModified" content="{{ Carbon\Carbon::parse($actie->updated_at)->toIso8601String() }}">
        <meta class="uk-margin-remove-adjacent" property="datePublished" content="{{ Carbon\Carbon::parse($actie->created_at)->toIso8601String() }}">

        <div class="grid grid-cols-12 max-w-4xl mx-auto mt-6 gap-5">
            <div id="right-container" class="col-span-12 sm:order-last sm:col-span-4">
                <div class="content flex flex-col gap-4 h-full">
                    <!-- Image and tags -->
                    <div class="flex-shrink-0 not-prose rounded-lg shadow-lg overflow-hidden" style="position:relative;">
                        @if ($actie->image_path)
                            <img class="object-cover w-full h-48" src="{{ $actie->image_path ?? asset('images/default_thumbnail.png') }}" alt="">
                        @else
                            <div class="h-[150px] bg-gradient-to-r from-[var(--wkid-pink-light)] to-[var(--wkid-blue-light)] text-white flex items-center justify-center">
                                @svg('custom-logo-icon', ['style' => 'fill: currentColor; height: 80px;'])
                            </div>
                        @endif
                        <ul class="themes-container p-2 absolute top-0 w-full">
                            @foreach ($actie->themes as $actieTheme)
                                <li
                                    class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                                    style="background-color: {{ $actieTheme->color }}"
                                >
                                    <span class="text-white">
                                        {{ $actieTheme->name }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="distance-container text-right p-2 absolute bottom-0 w-full">
                            {{-- <div
                                v-if="actie.distance"
                                class="relative self-start inline-block bg-[color:var(--wkid-yellow-light)] px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                            >
                                <span class="text-white" rel="theme">
                                    <i class="fas fa-location-arrow"></i> &nbsp; {{ actie.distance + ' km' }}<br/>
                                </span>
                            </div> --}}
                        </div>
                        {{-- Mobile title & details --}}
                        <div class="flex flex-col gap-3 not-prose p-3 pt-4 bg-white overflow-hidden block sm:hidden">
                            @if($actie->afgelopen)
                                <div class="w-full inline-flex bg-blue-50 items-center space-x-3 px-4 py-2 text-base font-medium leading-6 border border-[color:var(--wkid-message-info)] rounded-md text-[color:var(--wkid-message-info-dark)]">
                                    @svg('clarity-info-standard-solid', ['style' => 'width: 20px; height: 20px'])
                                    <span>{{ __("acties.passed") }}</span>
                                </div>
                            @endif
                            <h1 class="leading-none">
                                <span>{{ $actie->title }}</span>
                            </h1>
                            @if (isset($actie->updated_at))
                                <span class="mt-0 italic text-sm font-normal">{{ __("acties.last_edit") }}: {{ $actie->updated_at }}</span>
                            @else
                                <span class="mt-0 italic text-sm font-normal">{{ __("acties.created_at") }}: {{ $actie->created_at }}</span>
                            @endif
                            <div class="details-container text-sm text-gray-500">
                                <div class="flex items-center text-sm leading-5 text-gray-700">
                                    @svg('antdesign-clock-circle-o', ['class' => 'shrink-0', 'style' => 'width: 20px; height: 20px'])
                                    &nbsp; <span class="font-medium">{{ $actie->start }}</span><br/>
                                </div>
                                <div class="flex items-center text-sm leading-5 text-gray-700">
                                    @svg('antdesign-environment-o', ['class' => 'shrink-0', 'style' => 'width: 20px; height: 20px'])
                                    &nbsp; <span class="font-medium">{{ $actie->location_human }}</span>
                                </div>
                            </div>
                            <a href="{{ $actie->externe_link }}" class="w-full inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[color:var(--wkid-pink)] hover:bg-[color:var(--wkid-pink-dark)]">
                                @svg('antdesign-link-o', ['style' => 'width: 20px; height: 20px']) &nbsp; {{ __("acties.to_action_page") }}
                            </a>
                        </div>
                    </div>
                    <!-- Details -->
                    <div class="sm:flex flex-col gap-3 not-prose p-3 bg-white rounded-lg shadow-lg overflow-hidden hidden">
                        <h3>{{ __("acties.details") }}</h3>
                        <div class="details-container text-sm text-gray-500">
                            <div class="flex items-center text-sm leading-5 text-gray-700">
                                @svg('antdesign-clock-circle-o', ['class' => 'shrink-0', 'style' => 'width: 20px; height: 20px'])
                                &nbsp; <span class="font-medium">{{ $actie->start }}</span><br/>
                            </div>
                            <div class="flex items-center text-sm leading-5 text-gray-700">
                                @svg('antdesign-environment-o', ['class' => 'shrink-0', 'style' => 'width: 20px; height: 20px'])
                                &nbsp; <span class="font-medium">{{ $actie->location_human }}</span>
                            </div>
                        </div>
                        <a href="{{ $actie->externe_link }}" class="w-full inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[color:var(--wkid-pink)] hover:bg-[color:var(--wkid-pink-dark)]">
                            @svg('antdesign-link-o', ['style' => 'width: 20px; height: 20px']) &nbsp; {{ __("acties.to_action_page") }}
                        </a>
                    </div>
                    @if ($actie->__geoloc)
                        <div class="flex-col gap-3 not-prose bg-white rounded-lg shadow-lg overflow-hidden">
                            <div id="app">
                                <simple-map
                                    :center="{{ json_encode($actie->__geoloc) }}"
                                    :height="'200px'"
                                >
                                </simple-map>
                            </div>
                        </div>
                    @endif
                    <!-- About the organizer -->
                    <div class="not-prose flex flex-col gap-3 p-3 bg-white rounded-lg shadow-lg overflow-hidden">
                        @if (count($actie->organizers) > 1)
                            <h3>{{ __("acties.about_organizers") }}</h3>
                        @else
                            <h3>{{ __("acties.about_organizers") }}</h3>
                        @endif

                        @foreach ($actie->organizers as $organizer)
                            <a href="{{ $organizer->link }}">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-10 h-10 rounded-full" src="{{ $organizer->logo_path }}" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium hover:underline leading-5 text-gray-900">
                                            {{ $organizer->name }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                            {{-- <div class="text-sm">
                                {!! filterScripts($organizer->description) !!}
                            </div> --}}
                        @endforeach
                    </div>
                </div>
            </div>

            <div id="left-container" class="col-span-12 p-8 bg-white rounded-lg shadow-lg sm:col-span-8">
                <div class="leading-none hidden sm:block">
                    @if($actie->afgelopen)
                        <div class="w-full inline-flex mb-5 bg-blue-50 items-center space-x-3 px-4 py-2 text-base font-medium leading-6 border border-[color:var(--wkid-message-info)] rounded-md text-[color:var(--wkid-message-info-dark)]">
                            @svg('clarity-info-standard-solid', ['style' => 'width: 20px; height: 20px'])
                            <span>{{ __("acties.passed") }}</span>
                        </div>
                    @endif
                    <h1>{{ $actie->title }}</h1>
                    @if (isset($actie->updated_at))
                        <span class="mt-0 italic text-sm font-normal">{{ __("acties.last_edit") }}: <time datetime="{{ Carbon\Carbon::parse($actie->updated_at)->toIso8601String() }}">{{ Date::parse($actie->updated_at)->format("j F Y") }}</time></span>
                    @else
                        <span class="mt-0 italic text-sm font-normal">{{ __("acties.created_at") }}: <time datetime="{{ Carbon\Carbon::parse($actie->created_at)->toIso8601String() }}">{{ Date::parse($actie->created_at)->format("j F Y") }}</time></span>
                    @endif
                </div>
                <h3 class="leading-none block sm:hidden mt-0">
                    <span>{{ __("acties.description") }}</span>
                </h3>
                <div class="text-base">
                    {!! filterScripts($actie->body) !!}
                </div>
            </div>
    </article>

@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush