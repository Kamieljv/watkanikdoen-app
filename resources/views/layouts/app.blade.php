<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{-- Generate SEO --}}
    {!! SEO::generate(true) !!}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="url" content="{{ url('/') }}">

    <!-- Get Language file for Vue -->
    <script src="/lang-{{ app()->getLocale() }}.js"></script>
    <!-- Umami Web Stats -->
    @if(config('umami.key'))
        <script async defer data-website-id="{{ config('umami.key') }}" src="{{ config('umami.url') }}/script.js"></script>
    @endif

    @vite(['resources/views/assets/js/app.js', 'resources/views/assets/sass/app.scss'])
</head>
<body class="flex flex-col min-h-screen @if(Request::is('/')){{ 'bg-white' }}@else{{ 'bg-gray-50' }}@endif">

    @if(Request::is('/'))
        @include('partials.home-header')
    @else
        @include('partials.header')
    @endif

    <main class="flex-grow overflow-x-hidden min-h-[500px]">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Full Screen Loader -->
    <div id="fullscreenLoader" class="fixed inset-0 top-0 left-0 z-50 flex flex-col items-center justify-center hidden w-full h-full bg-gray-900 opacity-50">
        <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p id="fullscreenLoaderMessage" class="mt-4 text-sm font-medium text-white uppercase"></p>
    </div>
    <!-- End Full Loader -->

    <!-- Scripts -->
    @stack('scripts')

    {{-- <!-- Cookie notice -->
    <div id="cookie-container" class="">
        @include('partials.cookies')
    </div> --}}

    <!-- Toast messages -->
    <div id="toast-container">
        @include('partials.toast')
    </div>
</body>
</html>
