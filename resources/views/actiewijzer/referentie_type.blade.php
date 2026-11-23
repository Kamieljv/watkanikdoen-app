@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 flex">
        <a id="backToResultBtn" href="{{ session('previous_url') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            @svg('custom-arrow-left', 'w-4 h-4 mr-2')
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
                :routes="{{ json_encode($routes) }}"
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