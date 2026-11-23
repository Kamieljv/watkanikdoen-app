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

    <!-- Feedback tab (desktop only) -->
    @unless(Route::is('feedback.create'))
        <a href="{{ route('feedback.create') }}"
            class="fixed right-0 z-40 hidden px-2 py-2 text-sm font-medium tracking-wide text-blue-600 border-l border-t border-b border-blue-600 transition-colors duration-150 -translate-y-1/2 bg-white shadow-md lg:block top-1/2 rounded-l-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-300"
            style="writing-mode: vertical-rl;">
            <span class="inline-block rotate-180">{{ __('feedback.tab') }}</span>
        </a>
    @endunless

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