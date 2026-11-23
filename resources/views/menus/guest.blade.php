<nav class="flex items-center justify-end w-full h-full gap-7">
    <a href="/acties" class="hidden lg:block text-base font-medium">
        {{ __("menus.acties") }}
    </a>
    <a href="{{ route('organizers.index') }}" class="hidden lg:block text-base font-medium">
        {{ __("menus.organizers") }}
    </a>
    <a href="/boeken" class="hidden lg:block text-base font-medium">
        {{ __("menus.books") }}
    </a>
    <a href="{{ config('app.donate_link') }}" class="hidden lg:block text-base font-medium" target="_blank">
        {{ __("menus.donate") }}
    </a>
    <div class="hidden md:flex items-center justify-center gap-4">
        <span class="inline-flex rounded-md shadow-sm">
            <a href="{{ route('report.landing') }}"
                class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-500 hover:bg-blue-600"
                data-umami-event="Report action button in header">
                {{ __("menus.report_action") }}
            </a>
        </span>
    </div>

    {{-- Hamburger: opens the menu panel (menus/guest-mobile), on all screen sizes --}}
    <div class="header-icon flex items-center -ml-3">
        <button @click="mobileMenuOpen = true" type="button" aria-label="{{ __('menus.more') }}" aria-haspopup="true"
            x-bind:aria-expanded="mobileMenuOpen"
            class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-md cursor-pointer hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
            <svg class="w-6 h-6" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
            </svg>
        </button>
    </div>
</nav>
