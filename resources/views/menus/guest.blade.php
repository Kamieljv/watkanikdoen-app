<nav class="flex items-center justify-end hidden w-full h-full space-x-10 lg:flex">
    <a href="/hoe-werkt-het" class="text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("menus.hoe_werkt_het") }}
    </a>
    <a href="/word-vrijwilliger" class="text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("menus.word_vrijwilliger") }}
    </a>
    <a href="{{ route('organizers.index') }}" class="text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("menus.organizers") }}
    </a>
    <a href="/over-ons" class="hidden lg:block text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("menus.about_us") }}
    </a>
    <span class="transparent-button inline-flex rounded-md shadow-sm">
        <a href="{{ route('login') }}" class="flex items-center justify-center w-full px-4 py-2 text-base font-medium leading-6 text-blue-500 transition duration-150 ease-in-out border rounded-md border-1 border-blue-500 hover:bg-blue-500/25">
            {{__("Log In")}}
        </a>
    </span>
    <span class="inline-flex rounded-md shadow-sm" style="margin-left: 10px">
        <a href="{{ route('report.landing') }}" class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-500 hover:bg-blue-600">
            {{ __("menus.report_action") }}
        </a>
    </span>
</nav>
<div class="flex justify-end flex-grow lg:hidden">
    <button @click="mobileMenuOpen = true" type="button" class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
        <svg class="w-6 h-6" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
    </button>
</div>
