@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 flex">
        <a id="backToResultBtn" href="{{ session('previous_url') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("actiewijzer.back_to_actiewijzer_result") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 px-5">
        <h1>{{ $referentie_type->title }}</h1>
        <p class="mt-4">
            {!! $referentie_type->description !!}
        </p>
    </div>

    <div class="max-w-6xl mx-auto mt-6 px-5">
        <div id="app" class="mb-40">
            <referenties
                :routes="{{ $routes }}"
                :themes="{{ $themes }}"
                :referentie-type-id="{{ $referentie_type->id }}"
                :themes-selected-ids="{{ json_encode($themes_selected_ids) }}"
            />
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        if (localStorage.getItem('actiewijzer_result_url')) {
            document.getElementById('backToResultBtn').href = localStorage.getItem('actiewijzer_result_url');
        };
    </script>
@endpush