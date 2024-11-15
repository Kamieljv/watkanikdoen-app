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
    <meta name="theme-color" content="#ffffff">
    <meta name="url" content="{{ url('/') }}">

    <!-- Vite script and css -->
    @vite(['resources/views/assets/js/app.js', 'resources/views/assets/sass/app.scss'])

    <!-- Get Language file for Vue -->
    <script src="/lang-{{ app()->getLocale() }}.js"></script>
</head>
<body class="flex flex-col min-h-screen @if(Request::is('/')){{ 'bg-white' }}@else{{ 'bg-gray-50' }}@endif">

    @include('partials.widget-header')

    <main class="flex-grow overflow-x-hidden mt-24">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    @stack('scripts')

</body>
</html>
