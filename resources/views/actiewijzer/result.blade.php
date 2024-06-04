@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('actiewijzer.landing') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("actiewijzer.back_to_actiewijzer") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 mb-40 px-5 lg:px-0">
        <div id="app" class="p-8 bg-white rounded-md shadow-md min-h-[400px]">

            <h1 class="md:text-6xl text-center">{{ __('actiewijzer.results_header') }}</h1>

            {{-- Summary --}}
            <collapsible 
                id="summary-collapsible"
                class="mt-10"
                trigger-label="{{ __('actiewijzer.results_summary_header') }}"
                label-style="font-size: 25px;"
                icon="bxs-bar-chart"
                :is-open="false"
                v-cloak
            >
                <p class="font-normal">{{ __('actiewijzer.results_summary_body') }}
                
                <div class="mt-10">
                    @foreach ($dimensions as $dim)
                        <div class="mb-2 flex flex-col md:flex-row justify-between md:items-center">
                            <div class="flex">
                                <p class="font-bold">{{$dim->name}}</p>
                                <span title="{{ $dim->description }}">@svg('custom-clarity-info-circle-solid', ['style' => 'width: 22px; height: 22px'])</span>
                            </div>
                            <progress-bar :value="{{$dim->score}}" class="w-full md:w-4/5" :min="0" :max="{{config('app.actiewijzer.max_score')}}" color="var(--wkid-pink)" background-color="#C9C9C9"/>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    <h4 class="text-lg mb-2">Thema's</h4>
                    <div class="flex">
                        @foreach ($themes as $t)
                            <div
                                class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 uppercase rounded"
                                style="background-color: {{ $t->color }}"
                            >
                                <span class="text-white text-sm">{{ $t->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </collapsible>

            {{-- Themes --}}
            @if($themes != null)
            <div class="mt-20">
                <h2>Demonstraties voor de thema's 
                    @foreach($themes as $key=>$theme)
                        <span class="underline underline-offset-2" style="text-decoration-color: {{ $theme->color }}; text-decoration-thickness: 4px;">
                            {{ $theme->name }}</span>
                        @if ($key < $themes->count() - 2), @endif
                        @if ($key == $themes->count() - 2) en @endif
                    @endforeach
                </h2>
                <actie-agenda
                    :routes="{{ $routes }}"
                    :filterable="false"
                    :theme-ids="{{ json_encode(array_column($themes->toArray(), 'id')) }}"
                    :narrower="true"
                    :skeletons="2"
                    :limit="4"
                >
                </actie-agenda>
            </div>
            @endif

            @if(count($referentie_types) > 0)
                @foreach($referentie_types as $rt)
                    <div class="mt-20">
                        <h2>{{$rt->title}}&nbsp;<span class="text-pink-600">{{$rt->match_perc}}%</span></h2>
                        <p>{!! filterScripts($rt->description) !!}</p>
                        <div class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            @foreach ($rt->referenties->toArray() as $ref)
                                <Referentie
                                    :referentie="{{json_encode($ref)}}"
                                > </Referentie>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

@endsection

@push('scripts')
	<script type="application/javascript">
		var app = new Vue({
			el: '#app',
		});
	</script>
@endpush