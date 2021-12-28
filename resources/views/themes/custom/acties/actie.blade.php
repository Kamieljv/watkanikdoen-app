@extends('theme::layouts.app')

@section('content')

    <div class="max-w-4xl flex px-5 mx-auto mt-10 lg:px-0">
        <a href="{{ route('wave.home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_acties") }}
        </a>
    </div>
    <article id="post-{{ $actie->id }}" class="max-w-4xl px-5 mb-4 mx-auto prose lg:px-0">
        <meta property="name" content="{{ $actie->title }}">
        <meta property="author" typeof="Person" content="admin">
        <meta property="dateModified" content="{{ Carbon\Carbon::parse($actie->updated_at)->toIso8601String() }}">
        <meta class="uk-margin-remove-adjacent" property="datePublished" content="{{ Carbon\Carbon::parse($actie->created_at)->toIso8601String() }}">

        <div class="grid grid-cols-12 max-w-4xl mx-auto mt-6 gap-5">
            <div id="right-container" class="col-span-12 sm:order-last sm:col-span-4">
                <div class="content flex flex-col gap-4 h-full">
                    <!-- Image and tags -->
                    <div class="flex-shrink-0 not-prose rounded-lg shadow-lg overflow-hidden" style="position:relative;">
                        <img class="object-cover w-full h-48" src="{{ $actie->image_path }}" alt="">
                        <ul class="themes-container p-2 absolute top-0 w-full">
                            {{-- <li 
                                v-for="theme in actie.themes"
                                :key="theme.id"
                                class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                            >
                                <span class="text-gray-700" rel="theme">
                                    {{ theme.name }}
                                </span>
                            </li> --}}
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
                    </div>
                    {{-- Mobile title --}}
                    <div class="not-prose p-3 bg-white rounded-lg shadow-lg overflow-hidden">
                        <h1 class="leading-none block sm:hidden">
                            <span>{{ $actie->title }}</span>
                        </h1>
                    </div>
                    <!-- Details -->
                    <div class="not-prose p-3 bg-white rounded-lg shadow-lg overflow-hidden">
                        <h3>{{ __("acties.details") }}</h3>
                        <div class="details-container text-sm text-gray-500">
                            <div class="time">
                                <i class="far fa-calendar"></i> &nbsp; {{ $actie->start }}<br/>
                            </div>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i> &nbsp; {{ $actie->location_human }}
                            </div>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div>
                        <button href="{{ $actie->link }}" class="w-full inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[color:var(--wkid-pink)] hover:bg-[color:var(--wkid-pink-dark)]">
                            <i class="fas fa-link"></i> &nbsp; {{ __("acties.to_organizer") }}
                        </button>
                    </div>
                    <!-- About the organizer -->
                    <div class="not-prose p-3 bg-white rounded-lg shadow-lg overflow-hidden">
                        <h3>{{ __("acties.about_organizer") }}</h3>
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink-0">
                                <a href="#">
                                    <img class="w-10 h-10 rounded-full" src="{{ $actie->user->avatar_path }}" alt="">
                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm leading-5 text-gray-900">
                                    <a href="#" class="font-medium">{{ $actie->user->name }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="left-container" class="col-span-12 p-8 bg-white rounded-lg shadow-lg sm:col-span-8">
                <h1 class="leading-none hidden sm:block">
                    <span>{{ $actie->title }}</span>
                </h1>
                <h3 class="leading-none block sm:hidden mt-0">
                    <span>{{ __("acties.description") }}</span>
                </h3>
                <div class="text-base">
                    {!! $actie->body !!}
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