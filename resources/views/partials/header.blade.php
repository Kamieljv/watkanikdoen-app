<header id="header" x-data="{ mobileMenuOpen: false }" class="border-b-2 border-gray-100 relative z-30 gradient-border-b">
    <div class="px-3 md:px-8 mx-auto xl:px-0 max-w-6xl border-b-1 border-[#cecece8c]">
        <div class="flex items-center justify-between h-24 md:justify-start md:space-x-6">
            <div class="inline-flex h-5/6 w-1/3 md:w-1/4">
                <a id="header-logo-link" href="{{ route('home') }}" class="inline-flex h-full w-full items-center justify-start transition-all duration-1000 ease-out transform text-gray-900">
                    @svg('custom-logo-full', ['style' => 'fill: currentColor; height: 100%; width: auto;'])
                </a>
            </div>
            <!-- This is the homepage nav when a user is not logged in -->
            @if(auth()->guest())
                @include('menus.guest')
            @else <!-- Otherwise we want to show the menu for the logged in user -->
                @include('menus.authenticated')
            @endif

        </div>
    </div>

    @if(auth()->guest())
        @include('menus.guest-mobile')
    @else
        @include('menus.authenticated-mobile')
    @endif
</header>
