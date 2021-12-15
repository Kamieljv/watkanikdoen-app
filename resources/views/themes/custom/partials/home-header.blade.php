<header id="header" x-data="{ mobileMenuOpen: false }" class="fixed inset-x-0 top-0 text-white z-30 transition-all duration-100">
    <div class="px-8 mx-auto xl:px-5 max-w-6xl border-b-1 border-[#cecece8c]">
        <div class="flex items-center justify-between h-20 md:justify-start md:space-x-6">
            <div class="inline-flex">
            <!-- data-replace='{ "translate-y-12": "translate-y-0", "scale-110": "scale-100", "opacity-0": "opacity-100" }' -->
                <a id="header-logo-link" href="{{ route('wave.home') }}" class="flex items-center justify-center space-x-3 transition-all duration-1000 ease-out transform text-white">
                    @svg('icon-logo', ['style' => 'stroke: currentColor; height: 52px;'])
                </a>     
            </div>
            <h1>{{ setting('site.title') }}</h1>
            
            <div class="flex justify-end flex-grow -my-2 -mr-2 md:hidden">
                <button @click="mobileMenuOpen = true" type="button" class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                </button>
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