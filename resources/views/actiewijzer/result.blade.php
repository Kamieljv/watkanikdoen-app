@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_home") }}
        </a>
    </div>

    <div class="max-w-4xl mx-auto mt-6 mb-40 px-5 lg:px-0">
        <div id="app">

            <h1 class="md:text-6xl">{{ __('actiewijzer.results_header') }}

            {{-- Summary --}}
            <div class="mt-20 p-6 bg-gray-200 rounded-xl">
                <h2>{{ __('actiewijzer.results_summary_header') }}</h2>
                <p class="text-base font-normal">{{ __('actiewijzer.results_summary_body') }}
                
                <div class="mt-10">
                    @foreach ($dimensions as $dim)
                        @if(array_key_exists($dim->name, $scores))
                            <div class="mb-2 flex justify-between items-center">
                                <div class="flex">
                                    <p class="text-lg">{{$dim->name}}</p>
                                    <span title="{{ $dim->description }}">@svg('custom-clarity-info-circle-solid', ['style' => 'width: 22px; height: 22px'])</span>
                                </div>
                                <progress-bar :value="{{ $scores[$dim->name] }}" :min="0" :max="{{config('app.actiewijzer.max_score')}}" color="var(--wkid-pink)" background-color="#C9C9C9" style="width: 80%" />
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="mt-10">
                    <h4 class="text-xl mb-2">Thema's</h4>
                    <div class="flex">
                        @foreach ($themes as $t)
                            <div
                                class="relative self-start inline-block px-2 py-1 mr-1 mb-1 cursor-pointer text-xs font-medium leading-5 uppercase rounded"
                                style="background-color: {{ $t->color }}"
                            >
                                <span class="text-white">{{ $t->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Themes --}}
            @if($themes != null)
            <div class="mt-20">
                <h2>Omdat je je voor
                    @foreach($themes as $key=>$theme)
                        <span class="underline underline-offset-2" style="text-decoration-color: {{ $theme->color }}; text-decoration-thickness: 4px;">
                            {{ $theme->name }}</span>
                        @if ($key < $themes->count() - 2), @endif
                        @if ($key == $themes->count() - 2) en @endif
                    @endforeach
                    wil inzetten
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