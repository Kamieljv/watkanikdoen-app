@extends('theme::layouts.app')

@section('content')
    <div class="row">
        <div id="colored-banner" class="h-[300px] bg-gradient-to-br from-[var(--wkid-red)] to-[var(--wkid-blue)] flex items-bottom pb-[50px] justify-center">
        </div>
    </div>
    <div class="row">
        <div id="welcome" class="md:max-w-2xl h-[160px] m-auto text-center space-y-6 flex flex-col items-center justify-center">
            <h2 class="uppercase">Wat kan ik doen?</h2>
            <p>Welkom bij de startpagina voor actief burgerschap. 
                Vind demonstraties, organisaties, en meer voor de thema's die jij
                 belangrijk vindt.</p>
        </div>
    </div>
    <div id="app" class="px-8 xl:px-5">
        <actie-agenda
            :routes="{{ $routes }}"
            :themes="{{ $themes }}"
        >
        </actie-agenda>
    </div>
@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush