<header id="header" x-data="{ mobileMenuOpen: false }" class="fixed inset-x-0 top-0 text-white z-30 transition-all duration-100">
    <div class="px-8 mx-auto xl:px-5 max-w-6xl border-b-1 border-[#cecece8c]">
        <div class="flex items-center justify-between h-20 md:justify-start md:space-x-6">
            <div class="inline-flex">
            <!-- data-replace='{ "translate-y-12": "translate-y-0", "scale-110": "scale-100", "opacity-0": "opacity-100" }' -->
                <a id="header-logo-link" href="{{ route('wave.home') }}" class="flex items-center justify-center space-x-3 transition-all duration-1000 ease-out transform text-white">
                    @svg('icon-logo', ['style' => 'stroke: currentColor; height: 52px;'])
                </a>
            </div>
            <h1 class="hidden md:block">{{ setting('site.title') }}</h1>

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

@push('scripts')
    <script type="application/javascript">
        window.addEventListener("scroll", function () {
            if (window.scrollY > 100) {
                document.getElementById('header').classList.add("detatched");
            }
            else {
                document.getElementById('header').classList.remove("detatched");
            }
        });
    </script>
@endpush
