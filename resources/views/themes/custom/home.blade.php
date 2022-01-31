@extends('theme::layouts.app')

@section('content')
    <div class="relative">
        <div id="image-banner" style="background-image:url(images/Banner_nocolor.jpg);"
        class="h-[300px] bg-center bg-cover grayscale brightness-[0.7] contrast-[1.5]"></div>
        <div id="gradient-banner" class="absolute inset-0 bg-gradient-to-r from-[var(--wkid-pink)] to-[var(--wkid-blue)] opacity-70"></div>
    </div>
    <div class="row">
        <div id="welcome" class="md:max-w-2xl my-5 m-auto text-center space-y-3 flex flex-col items-center justify-center">
            <h2 class="uppercase">Wat kan ik doen?</h2>
            @svg('custom-vormpje', ['style' => 'fill: var(--wkid-blue-light); height: 20px;'])
            <p>Welkom bij de startpagina voor actief burgerschap.<br/>
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