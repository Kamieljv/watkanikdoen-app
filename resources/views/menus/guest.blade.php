<nav class="flex items-center justify-end w-full h-full gap-7">
    <a href="/acties" class="hidden lg:block text-base font-medium">
        {{ __("menus.acties") }}
    </a>
    <a href="{{ route('organizers.index') }}" class="hidden lg:block text-base font-medium">
        {{ __("menus.organizers") }}
    </a>
    <a href="/over-ons" class="hidden lg:block text-base font-medium">
        {{ __("menus.about_us") }}
    </a>
    <a href="/word-vrijwilliger" class="hidden lg:block shrink-0 text-base font-medium">
        {{ __("menus.word_vrijwilliger") }}
    </a>
    <a href="{{ config('app.donate_link') }}" class="hidden lg:block text-base font-medium" target="_blank">
        {{ __("menus.donate") }}
    </a>
    <div class="hidden md:flex items-center justify-center gap-4">
        <span class="transparent-button inline-flex rounded-md shadow-sm">
            <a href="{{ route('login') }}" class="flex items-center justify-center w-full px-4 py-2 text-base font-medium leading-6 text-blue-500 transition duration-150 ease-in-out border rounded-md border-1 border-blue-500 hover:bg-blue-500/25">
                {{__("menus.log_in")}}
            </a>
        </span>
        <span class="inline-flex rounded-md shadow-sm">
            <a href="{{ route('report.landing') }}" class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-500 hover:bg-blue-600"
                data-umami-event="Report action button in header"
            >
                {{ __("menus.report_action") }}
            </a>
        </span>
    </div>
</nav>
<div class="flex justify-end flex-1 lg:hidden">
    <button @click="mobileMenuOpen = true" type="button" class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
        <svg class="w-6 h-6" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
    </button>
</div>
