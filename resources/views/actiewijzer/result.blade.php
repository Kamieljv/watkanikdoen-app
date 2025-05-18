@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('actiewijzer.landing') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("actiewijzer.back_to_actiewijzer") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 mb-40 px-0">
        <div id="app" class="p-8 bg-white rounded-md shadow-md min-h-[400px]">

            <h1 class="md:text-6xl text-center">{{ __('actiewijzer.results_header') }}</h1>

            {{-- Summary --}}
            <collapsible 
                id="summary-collapsible"
                class="mt-10"
                trigger-label="{{ __('actiewijzer.results_summary_header') }}"
                label-style="font-size: 25px;"
                icon="bxs-bar-chart"
                :is-open="true"
                v-cloak
            >
                <p class="font-normal">{{ __('actiewijzer.results_summary_body') }}
                
                <div class="mt-10 gap-6 grid grid-cols-2">
                    <div class="w-full col-span-2 md:col-span-1">
                        <h4 class="text-lg mb-2">Type acties die bij jou passen</h4>
                        <div class="flex flex-wrap">
                            @foreach($referentie_types as $rt)
                                <a href="#{{str_replace(' ', '_', $rt->title)}}" class="mr-1">
                                    <div class="bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded-full mb-1">
                                        {{$rt->title}}
                                        &nbsp;
                                        @if($rt->match_perc)<span class="text-pink-600 font-bold">{{$rt->match_perc}}%</span>@endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="w-full col-span-2 md:col-span-1 mt-5 md:mt-0">
                        <h4 class="text-lg mb-2">Voorkeuren</h4>
                        @foreach ($dimensions as $dim)
                            <div class="mb-2 flex flex-col justify-between">
                                <div class="flex">
                                    <p>{{$dim->name}}</p>
                                    <span title="{{ $dim->description }}">@svg('custom-clarity-info-circle-solid', ['style' => 'width: 22px; height: 22px'])</span>
                                </div>
                                <progress-bar :value="{{$dim->score}}" class="w-full" :min="0" :max="{{config('app.actiewijzer.max_score')}}" color="var(--wkid-pink)" background-color="#C9C9C9"/>
                            </div>
                        @endforeach
                    </div> --}}
                    <div class="w-full col-span-2 md:col-span-1">
                        @if ($themes->count() > 0)
                            <h4 class="text-lg mb-2">Thema's</h4>
                            <div class="flex flex-wrap">
                                @foreach ($themes as $t)
                                    <div
                                        class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 uppercase rounded"
                                        style="background-color: {{ $t->color }}"
                                    >
                                        <span class="text-white text-sm">{{ $t->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-3 md:mt-10 md:gap-6 grid grid-cols-2">
                    <div class="w-full col-span-2 mt-5 md:mt-0">
                        <h4 class="text-lg mb-2">Bewaren & Delen </h4>
                        <p class="mb-2">Sla de link hieronder op in je Bladwijzers of Favorieten of deel de link met je vrienden!</p>
                        <div class="flex gap-2">
                            <a href="https://t.me/share/url?url={{ urlencode(url()->full()) }}&text={{ urlencode('Ik heb de actiewijzer ingevuld en dit is het resultaat!') }}"
                                target="_blank"
                                class="min-w-20 inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[#0088cc] hover:bg-[#006699]"
                                title="{{ __('acties.share_via') . " Telegram"}}"
                                data-umami-event="Telegram share of ActieWijzer result">
                                @svg('bxl-telegram', ['class' => 'w-6 h-6'])
                            </a>
                            <a href="https://wa.me/?text={{ urlencode('Ik heb de actiewijzer ingevuld en dit is het resultaat!' . ' - ' . url()->full()) }}"
                                target="_blank"
                                class="min-w-20 inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[#25D366] hover:bg-[#128C7E]"
                                title="{{ __('acties.share_via') . " WhatsApp"}}"
                                data-umami-event="WhatsApp share of ActieWijzer result">
                                @svg('bxl-whatsapp', ['class' => 'w-7 h-7'])
                            </a>                                    
                            <button
                                onclick="navigator.clipboard.writeText(window.location.href); this.classList.add('bg-green-600'); setTimeout(() => this.classList.remove('bg-green-600'), 1000)"
                                class="min-w-20 inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-gray-500 hover:bg-gray-600"
                                title="{{ __('acties.copy_link') }}"
                                data-umami-event="Copy link of ActieWijzer result">
                                @svg('clarity-copy-line', ['class' => 'w-5 h-5', 'title' => __('acties.copy_link')])
                            </button>
                        </div>
                    </div>
                </div>
            </collapsible>

            @foreach($referentie_types as $rt)
                <div class="mt-20 p-6 bg-gray-50 rounded-lg">
                    <h2 id="{{str_replace(' ', '_', $rt->title)}}" class="mb-4">
                        {{$rt->title}}&nbsp;
                        @if($rt->match_perc)<span class="text-pink-600">{{$rt->match_perc}}%</span>@endif
                    </h2>
                    <p>{!! Purify::clean($rt->description) !!}</p>
                    @if ($rt->title == config('app.actiewijzer.demonstrations_section_name') && $has_relevant_acties)
                        <p class="mt-3"><i>Demonstraties voor
                            @if($themes->count() == 1) het thema @else de thema's @endif
                            @foreach($themes as $key=>$theme)
                                <span class="underline underline-offset-2" style="text-decoration-color: {{ $theme->color }}; text-decoration-thickness: 4px;">
                                    {{ $theme->name }}</span>
                                @if ($key < $themes->count() - 2), @endif
                                @if ($key == $themes->count() - 2) en @endif
                            @endforeach
                        </i></p>
                        <actie-agenda
                            :routes="{{ $routes }}"
                            :filterable="false"
                            :themes="{{ $themes}}"
                            :themes-selected-ids="{{ json_encode(array_column($themes->toArray(), 'id')) }}"
                            :narrower="true"
                            :skeletons="2"
                            :limit="4"
                        >
                        </actie-agenda>
                        <div class="flex items-center justify-center mt-12">
                            <a href="{{ route('acties.agenda') . '?' . http_build_query(['themes' => array_column($themes->toArray(), 'id')])}}">
                                <button class="secondary flex items-center hover:translate-x-[0.250rem]">
                                    <p class="text-lg">Bekijk alle Acties</p> 
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 ml-1" style="transform: rotate(180deg);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>
                    @else
                        @if($rt->referenties->count() > 0)
                            <div>
                                <referenties
                                    :referenties-fixed="{{ json_encode($rt->referenties) }}"
                                    :filterable="false"
                                    :max="3"
                                />
                            </div>
                            <div class="flex items-center justify-center mt-12">
                                <a href="{{ $rt->link . '?' . http_build_query(['themes' => array_column($themes->toArray(), 'id')])}}">
                                    <button class="secondary flex items-center hover:translate-x-[0.250rem]">
                                        <p class="text-lg">Bekijk alles van {{ $rt->title }}</p> 
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 ml-1" style="transform: rotate(180deg);">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                    </button>
                                </a>
                            </div>
                        @else
                            <div class="flex flex-col justify-center items-center py-12 text-gray-400">
                                <h3>{{__('general.no_results')}}</h3>
                                <div class="flex flex-col items-center">
                                    <p>{{ __('actiewijzer.no_results_suggestion_retry_or_later') }}</p>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // add the current window location to local storage
            localStorage.setItem('actiewijzer_result_url', window.location.href);
        });
    </script>
@endpush
