<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    {{-- Generate SEO --}}
    {!! SEO::generate(true) !!}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="theme-color" content="#f30060">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    @vite(['resources/views/assets/sass/app.scss'])
</head>

<body class="min-h-screen bg-(--wkid-pink)">

    <main class="mx-auto max-w-md px-2">
        <div class="flex flex-col items-center px-5 pt-14 pb-10 bg-white/30 mx-auto my-5 max-w-md rounded-2xl">
            <a href="{{ route('home') }}"
                class="flex items-center justify-center w-20 h-20 mb-5 bg-white rounded-full shadow-lg ring-4 ring-white/30">
                @svg('custom-logo-full', ['class' => 'w-18 h-18', 'style' => 'fill: var(--wkid-pink);'])
            </a>

            <h1 class="text-xl font-bold text-center text-white">{{ config('brand.title_website') }}</h1>
            @include('partials.social-links', ['class' => 'flex items-center space-x-3 my-3'])
            <p class="mt-2 mb-8 text-sm text-center text-white/90">{{ config('brand.description') }}</p>

            <div class="flex flex-col w-full space-y-3">
                @forelse($links as $link)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center w-full gap-3 px-3 py-3 bg-white rounded-2xl shadow-md transition duration-150 ease-in-out hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0">
                        @if($link->thumbnail_url)
                            <img src="{{ $link->thumbnail_url }}" alt="" class="object-cover w-11 h-11 rounded-xl shrink-0">
                        @else
                            <span class="flex items-center justify-center w-11 h-11 rounded-xl shrink-0"
                                style="background-color: #f300601a;">
                                @svg('custom-logo-icon', ['class' => 'w-6 h-6', 'style' => 'fill: var(--wkid-pink);'])
                            </span>
                        @endif
                        <span class="flex-1 min-w-0">
                            <span class="block text-sm font-semibold text-gray-900 truncate">{{ $link->title }}</span>
                            <span class="block text-xs text-gray-500 truncate">{{ $link->subtitle }}</span>
                        </span>
                    </a>
                @empty
                    <p class="text-sm text-center text-white/70">{{ __('Er zijn nog geen links toegevoegd.') }}</p>
                @endforelse
            </div>

            <div class="mt-10 text-xs font-medium text-white/70">
                {{ config('brand.title') }} &copy; {{ date('Y') }}
            </div>
        </div>
    </main>

</body>

</html>