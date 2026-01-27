@php 
    $announcement = \App\Models\Announcement::orderby('created_at', 'DESC')->active()->first(); 
    $slug = basename(parse_url(url()->current(), PHP_URL_PATH));
    $show_announcement = $announcement && trim($announcement->url, '/') != $slug
@endphp
@if($show_announcement)
    @include('partials.announcement')
@endif
<header id="header" x-data="{ mobileMenuOpen: false }" class="fixed inset-x-0 text-white z-30 transition-all duration-100 {{ $show_announcement ? "top-12" : "top-0" }}">
    <div class="px-3 md:px-8 mx-auto xl:px-0 max-w-6xl">
        <div class="flex items-center justify-between h-20 md:h-24 md:justify-start md:space-x-6">
            <div class="inline-flex h-5/6 w-1/3 md:w-1/4">
                <a id="header-logo-link" href="{{ route('home') }}" class="inline-flex h-full w-full items-center justify-start transition-all duration-1000 ease-out transform text-white">
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
