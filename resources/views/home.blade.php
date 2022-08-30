@extends('layouts.app')

@section('content')
    <div class="relative">
        <div id="image-banner" style="background-image:url(images/Banner_nocolor.jpg);"
        class="h-[200px] md:h-[300px] bg-center bg-cover grayscale brightness-[0.7] contrast-[1.5]"></div>
        <div id="gradient-banner" class="absolute inset-0 bg-gradient-to-r from-[var(--wkid-pink)] to-[var(--wkid-blue)] opacity-70"></div>
        <h1 class="absolute w-full bottom-0 text-center leading-[0.7] text-white uppercase text-4xl md:text-5xl md:leading-[0.7]">
            {{ config('brand.title') }}
        </h1>
    </div>
    <div class="row">
        <div id="welcome" class="md:max-w-2xl px-3 md:px-0 my-8 m-auto text-center flex flex-col items-center justify-center">
            @svg('custom-vormpje', ['style' => 'fill: var(--wkid-blue-light); height: 100px; opacity: 0.2; position: absolute'])
            <p class="relative">
                {!! config('brand.description_html') !!}
            </p>
        </div>
    </div>
    <div id="app" class="px-3 xl:px-5">
        <actie-agenda
            :routes="{{ $routes }}"
            :themes="{{ $themes }}"
            :categories="{{ $categories }}"
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