@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            {{ __('acties.back_to_home') }}
        </a>
    </div>
    @if ($isAdmin)
        <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 mt-4">
            <div class="flex p-3 rounded-md bg-gray-600 text-white justify-between">
                {{ __('general.admin_message') }}
                <a href="/admin/acties/{{ $actie->id }}/edit" class="italic hover:underline">Actie bewerken</a>
            </div>
        </div>
    @endif
    <div id="app">
        <article id="post-{{ $actie->id }}"
            class="max-w-6xl px-5 mx-auto lg:px-0 mt-6 {{ $count_same_theme == 0 ? 'mb-40' : 'mb-24' }}">
            <meta property="name" content="{{ $actie->title }}">
            <meta property="author" typeof="Person" content="admin">
            <meta property="dateModified" content="{{ Carbon\Carbon::parse($actie->updated_at)->toIso8601String() }}">
            <meta class="uk-margin-remove-adjacent" property="datePublished"
                content="{{ Carbon\Carbon::parse($actie->created_at)->toIso8601String() }}">

            <div class="grid grid-cols-12 max-w-6xl mx-auto mt-6 gap-5">
                <div id="right-container" class="col-span-12 sm:order-last sm:col-span-4">
                    <div class="content flex flex-col gap-4 h-full">
                        <div class="flex-shrink-0 not-prose relative rounded-lg shadow-lg overflow-hidden">
                            <!-- Image and tags -->
                            <div class="relative w-full h-48">
                                @if ($actie->linked_image)
                                    <img class="object-cover w-full h-full" src="{{ $actie->linked_image->url }}"
                                        alt="">
                                @else
                                    <div
                                        class="h-full bg-gradient-to-r from-[var(--wkid-pink-light)] to-[var(--wkid-blue-light)] text-white flex items-center justify-center">
                                        @svg('custom-logo-icon', ['style' => 'fill: currentColor; height: 80px;'])
                                    </div>
                                @endif
                                <ul class="themes-container p-2 absolute top-0 w-full">
                                    @foreach ($actie->themes as $actieTheme)
                                        <li class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                                            style="background-color: {{ $actieTheme->color }}">
                                            <span class="text-white">
                                                {{ $actieTheme->name }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="categories-container p-2 absolute bottom-0 w-full flex flex-wrap">
                                    @foreach ($actie->categories as $actieCategorie)
                                        <li
                                            class="relative self-start inline-block bg-gray-100 px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded">
                                            <span class="flex items-center text-gray-800" rel="categorie">
                                                {{ $actieCategorie->name }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- Mobile title & details --}}
                            <div class="flex flex-col gap-3 not-prose p-3 pt-4 bg-white overflow-hidden block sm:hidden">
                                @if ($actie->afgelopen)
                                    <div
                                        class="w-full inline-flex bg-blue-50 items-center space-x-3 px-4 py-2 text-base font-medium leading-6 border border-[color:var(--wkid-message-info)] rounded-md text-[color:var(--wkid-message-info-dark)]">
                                        @svg('clarity-info-standard-solid', ['style' => 'width: 20px; height: 20px'])
                                        <span>{{ __('acties.passed') }}</span>
                                    </div>
                                @endif
                                <h1 class="leading-none">
                                    <span>{{ $actie->title }}</span>
                                </h1>
                                <div class="flex justify-between">
                                    <span class="flex items-center mt-0 italic text-sm font-normal">
                                        @if (isset($actie->updated_at))
                                            {{ __('acties.last_edit') }}:
                                            {{ Date::parse($actie->updated_at)->diffForHumans() }}
                                        @else
                                            {{ __('acties.created_at') }}: {{ $actie->created_at }}
                                        @endif
                                    </span>
                                    @if ($actie->pageviewsText)
                                        <span class="flex bg-gray-200 rounded-md p-1 text-sm bold font-normal"
                                            title="Aantal keer dat de pagina is bekeken">
                                            @svg('antdesign-eye', ['style' => 'width: 20px; height: 20px'])&nbsp;{{ $actie->pageviewsText }}
                                        </span>
                                    @endif
                                </div>
                                <div class="details-container text-sm text-gray-500 space-y-1">
                                    @if ($actie->start_end)
                                        <div class="flex items-center text-sm leading-5 text-gray-700">
                                            @svg('antdesign-clock-circle-o', ['class' => 'shrink-0', 'style' => 'width: 20px; height: 20px'])
                                            &nbsp; <span class="font-medium">{{ $actie->start_end }}</span><br />
                                        </div>
                                    @endif
                                    @if ($actie->location_human)
                                        <div class="flex items-center text-sm leading-5 text-gray-700">
                                            @svg('antdesign-environment-o', ['class' => 'shrink-0', 'style' => 'width: 20px; height: 20px'])
                                            &nbsp; <span class="font-medium">{{ $actie->location_human }}</span>
                                        </div>
                                    @endif
                                </div>
                                @if ($actie->disobedient === 1)
                                    <div class="p-3 text-sm rounded-md alert-warning">
                                        <div class="inline-flex items-center mb-3">
                                            @svg('antdesign-warning-o', ['style' => 'width: 20px; height: 20px']) &nbsp;
                                            <span class="font-bold">Burgerlijke ongehoorzaamheid</span>
                                        </div>
                                        <div>
                                            {!! __('acties.civdis_text') !!}
                                        </div>
                                    </div>
                                @endif
                                <div class="space-y-1">
                                    @foreach ($actie->externe_link as $externe_link)
                                        <?php
                                        preg_match('/(http(s)?:[\\/]+)?([a-z0-9.\-_]+)[\\/]?/', strtolower($externe_link), $label);
                                        if (substr($externe_link, 0, 4) != 'http') {
                                            $externe_link = 'https://' . $externe_link;
                                        }
                                        ?>
                                        <a href="{{ $externe_link }}" target="_blank"
                                            class="w-full inline-flex items-center justify-center space-x-1 px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[color:var(--wkid-pink)] hover:bg-[color:var(--wkid-pink-dark)]">
                                            @svg('antdesign-link-o', ['class' => 'flex-nowrap flex-shrink-0', 'style' => 'width: 20px; height: 20px'])
                                            <p class="truncate">
                                                {{ $label ? str_replace('www.', '', $label[3]) : $externe_link }}</p>
                                        </a>
                                    @endforeach
                                    @if ($actie->start_time && $actie->end_time && !$actie->afgelopen)
                                        <a href="{{ route('ical.actie', $actie->slug) }}" target="_blank" class="w-full inline-flex items-center justify-center space-x-1 px-4 py-2 text-base font-medium leading-6 text-gray-800 whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-gray-200 hover:bg-gray-300"
                                            data-umami-event="Add to calendar button (mobile)"
                                        >
                                            @svg('antdesign-calendar-o', ['class' => 'flex-nowrap flex-shrink-0', 'style' => 'width: 20px; height: 20px'])
                                            <p class="truncate">{{ __('acties.add_to_calendar') }}</p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Details -->
                        <div
                            class="sm:flex flex-col gap-3 not-prose p-3 bg-white rounded-lg shadow-lg overflow-hidden hidden">
                            <h4>{{ __('acties.details') }}</h4>
                            <div class="details-container text-sm text-gray-500 space-y-1">
                                @if ($actie->start_end)
                                    <div class="flex items-center text-sm leading-5 text-gray-700">
                                        @svg('antdesign-clock-circle-o', ['class' => 'shrink-0', 'style' => 'width: 20px; height: 20px'])
                                        &nbsp; <span class="font-medium">{{ $actie->start_end }}</span><br />
                                    </div>
                                @endif
                                @if ($actie->location_human)
                                    <div class="flex items-center text-sm leading-5 text-gray-700">
                                        @svg('antdesign-environment-o', ['class' => 'shrink-0', 'style' => 'width: 20px; height: 20px'])
                                        &nbsp; <span class="font-medium">{{ $actie->location_human }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-1">
                                @foreach ($actie->externe_link as $externe_link)
                                    <?php
                                    preg_match('/(http(s)?:[\\/]+)?([a-z0-9.\-_]+)[\\/]?/', strtolower($externe_link), $label);
                                    if (substr($externe_link, 0, 4) != 'http') {
                                        $externe_link = 'https://' . $externe_link;
                                    }
                                    ?>
                                    <a href="{{ $externe_link }}" target="_blank"
                                        class="w-full inline-flex items-center justify-center space-x-1 px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[color:var(--wkid-pink)] hover:bg-[color:var(--wkid-pink-dark)]">
                                        @svg('antdesign-link-o', ['class' => 'flex-nowrap flex-shrink-0', 'style' => 'width: 20px; height: 20px'])
                                        <p class="truncate">
                                            {{ $label ? str_replace('www.', '', $label[3]) : $externe_link }}</p>
                                    </a>
                                @endforeach
                                @if ($actie->start_time && $actie->end_time && !$actie->afgelopen)
                                    <a href="{{ route('ical.actie', $actie->slug) }}" target="_blank" class="w-full inline-flex items-center justify-center space-x-1 px-4 py-2 text-base font-medium leading-6 text-gray-800 whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-gray-200 hover:bg-gray-300"
                                        data-umami-event="Add to calendar button (desktop)"    
                                    >
                                        @svg('antdesign-calendar-o', ['class' => 'flex-nowrap flex-shrink-0', 'style' => 'width: 20px; height: 20px'])
                                        <p class="truncate">{{ __('acties.add_to_calendar') }}</p>
                                    </a>
                                @endif
                            </div>
                            @if ($actie->disobedient === 1)
                                <div class="p-3 text-sm rounded-md alert-warning">
                                    <div class="inline-flex items-center mb-3">
                                        @svg('antdesign-warning-o', ['style' => 'width: 20px; height: 20px']) &nbsp;
                                        <span class="font-bold">Burgerlijke ongehoorzaamheid</span>
                                    </div>
                                    <div>
                                        {!! __('acties.civdis_text') !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Social sharing -->
                        <div class="not-prose flex flex-col gap-3 p-3 bg-white rounded-lg shadow-lg overflow-hidden">
                            <h4>{{ __('acties.share') }}</h4>
                            <div class="flex gap-2">
                                <a href="https://bsky.app/intent/compose?text={{ urlencode($actie->title . " " . url()->current()) }}"
                                    target="_blank"
                                    class="w-1/4 inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[#1da1f2] hover:bg-[#0b7bc5]"
                                    title="{{ __('acties.share_via') . " BlueSky"}}"
                                    data-umami-event="BlueSky share of actie">
                                    @svg('bxl-bluesky', ['class' => 'w-6 h-6'])
                                </a>
                                @if($browser->isMobile())
                                    <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ rawurlencode($actie->title) }}"
                                        target="_blank"
                                        class="w-1/4 inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[#0088cc] hover:bg-[#006699]"
                                        title="{{ __('acties.share_via') . " Telegram"}}"
                                        data-umami-event="Telegram share of actie">
                                        @svg('bxl-telegram', ['class' => 'w-6 h-6'])
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($actie->title . ' - ' . url()->current()) }}"
                                        target="_blank"
                                        class="w-1/4 inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[#25D366] hover:bg-[#128C7E]"
                                        title="{{ __('acties.share_via') . " WhatsApp"}}"
                                        data-umami-event="WhatsApp share of actie">
                                        @svg('bxl-whatsapp', ['class' => 'w-7 h-7'])
                                    </a>                                    
                                @endif
                                <button
                                    onclick="navigator.clipboard.writeText(window.location.href); this.classList.add('bg-green-600'); setTimeout(() => this.classList.remove('bg-green-600'), 1000)"
                                    class="w-1/4 inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-gray-500 hover:bg-gray-600"
                                    title="{{ __('acties.copy_link') }}"
                                    data-umami-event="Copy link of actie">
                                    @svg('clarity-copy-line', ['class' => 'w-5 h-5', 'title' => __('acties.copy_link')])
                                </button>
                            </div>
                        </div>
                        @if ($actie->__geoloc)
                            <div class="flex-col gap-3 not-prose bg-white rounded-lg shadow-lg overflow-hidden">
                                <simple-map :center="{{ json_encode($actie->__geoloc) }}" :height="'200px'">
                                </simple-map>
                            </div>
                        @endif
                        <!-- About the organizer -->
                        <div class="not-prose flex flex-col gap-3 p-3 bg-white rounded-lg shadow-lg overflow-hidden">
                            @if (count($actie->organizers) > 1)
                                <h4>{{ __('acties.about_organizers') }}</h4>
                            @else
                                <h4>{{ __('acties.about_organizer') }}</h4>
                            @endif

                            @foreach ($actie->organizers as $organizer)
                                <a href="{{ $organizer->link }}">
                                    <div class="flex flex-row items-center">
                                        <div class="flex-shrink-0">
                                            @if ($organizer->linked_image)
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ $organizer->linked_image->url }}" alt="">
                                            @else
                                                <div
                                                    class="flex items-center justify-center text-xl w-10 h-10 rounded-full bg-gray-500 text-white border-gray-300">
                                                    {{ substr($organizer->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium hover:underline leading-5 text-gray-900">
                                                {{ $organizer->name }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                {{-- <div class="text-sm">
                                    {!! Purify::clean($organizer->description) !!}
                                </div> --}}
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="left-container" class="col-span-12 p-8 bg-white rounded-lg shadow-lg sm:col-span-8">
                    <div class="leading-none hidden sm:block">
                        @if ($actie->afgelopen)
                            <div
                                class="w-full inline-flex mb-5 bg-blue-50 items-center space-x-3 px-4 py-2 text-base font-medium leading-6 border border-[color:var(--wkid-message-info)] rounded-md text-[color:var(--wkid-message-info-dark)]">
                                @svg('clarity-info-standard-solid', ['style' => 'width: 20px; height: 20px'])
                                <span>{{ __('acties.passed') }}</span>
                            </div>
                        @endif
                        <h1>{{ $actie->title }}</h1>
                        <div class="flex justify-between mb-4">
                            <span class="flex items-center mt-0 italic text-sm font-normal">
                                @if (isset($actie->updated_at))
                                    {{ __('acties.last_edit') }}: {{ Date::parse($actie->updated_at)->diffForHumans() }}
                                @else
                                    {{ __('acties.created_at') }}: {{ $actie->created_at }}
                                @endif
                            </span>
                            @if ($actie->pageviewsText)
                                <span class="flex bg-gray-200 rounded-md p-1 text-sm bold font-normal"
                                    title="Aantal keer dat de pagina is bekeken">
                                    @svg('antdesign-eye', ['style' => 'width: 20px; height: 20px'])&nbsp;{{ $actie->pageviewsText }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <h3 class="leading-none block sm:hidden mt-0">
                        <span>{{ __('acties.description') }}</span>
                    </h3>
                    <div class="text-base mt-10">
                        {!! Purify::clean($actie->body) !!}
                    </div>
                </div>
        </article>

        {{-- More from this theme section --}}
        @if ($count_same_theme > 0)
            <div class="pb-40 text-gray-800 overflow-hidden bg-gray-100">
                <div class="max-w-6xl px-5 mx-auto lg:px-0 mt-10">
                    @if ($actie->themes->count() > 1)
                        <h2>Meer acties in de thema's
                            @foreach ($actie->themes as $key => $theme)
                                <span class="underline underline-offset-2"
                                    style="text-decoration-color: {{ $theme->color }}; text-decoration-thickness: 4px;">
                                    {{ $theme->name }}</span>
                                @if ($key < $actie->themes->count() - 2)
                                    ,
                                @endif
                                @if ($key == $actie->themes->count() - 2)
                                    en
                                @endif
                            @endforeach
                        </h2>
                    @else
                        <h2>Meer acties in het thema
                            <span class="underline underline-offset-2"
                                style="text-decoration-color: {{ $actie->themes[0]->color }}; text-decoration-thickness: 4px;">
                                {{ $actie->themes[0]->name }}
                            </span>
                        </h2>
                    @endif
                    <actie-agenda
                        :routes="{{ $routes }}"
                        :filterable="false"
                        :themes="{{ $themes }}"
                        :themes-selected-ids="{{ json_encode(array_column($actie->themes->toArray(), 'id')) }}"
                        :exclude-ids="{{ json_encode([$actie->id]) }}"
                        :narrower="true"
                        :skeletons="2"
                        :limit="4"
                    >
                    </actie-agenda>
                </div>
            </div>
        @endif
    </div>
@endsection
