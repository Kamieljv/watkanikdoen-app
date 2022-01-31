<header id="header" x-data="{ mobileMenuOpen: false }" class="border-b-2 border-gray-100 relative z-30 gradient-border-b">
    <div class="px-8 mx-auto xl:px-5 max-w-6xl">
        <div class="flex items-center justify-between h-24 md:justify-start md:space-x-6">
            <div class="inline-flex">
            <!-- data-replace='{ "translate-y-12": "translate-y-0", "scale-110": "scale-100", "opacity-0": "opacity-100" }' -->
                <a id="header-logo-link" href="{{ route('home') }}" class="flex items-center justify-center space-x-3 transition-all duration-1000 ease-out transform text-gray-900">
                    @svg('custom-logo-full', ['style' => 'fill: currentColor; height: 100px;'])
                </a>
            </div>

            <!-- This is the homepage nav when a user is not logged in -->
            @if(auth()->guest())
                @include('theme::menus.guest')
            @else <!-- Otherwise we want to show the menu for the logged in user -->
                @include('theme::menus.authenticated')
            @endif

        </div>
    </div>

    @if(auth()->guest())
        @include('theme::menus.guest-mobile')
    @else
        @include('theme::menus.authenticated-mobile')
    @endif
</header>
