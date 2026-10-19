<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    {!! SEO::generate(true) !!}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">

    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <script src="/lang-{{ app()->getLocale() }}.js"></script>
    @vite(['resources/views/assets/js/map.js', 'resources/views/assets/sass/app.scss'])
</head>
<body class="m-0 overflow-hidden">
    <div id="app" class="fixed inset-0">
        <actie-map></actie-map>
    </div>
</body>
</html>
