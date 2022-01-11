<nav class="flex items-center justify-end flex-1 hidden w-full h-full space-x-10 md:flex">

    <a href="{{ route('wave.blog') }}" class="text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("Blog") }}
    </a>
    <a href="/over_ons" class="hidden lg:block text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("general.about_us") }}
    </a>
    <a href="/contact" class="hidden lg:block text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("Contact") }}
    </a>
    <a href="{{ route('login') }}" class="text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("Log In") }}
    </a>
    <span class="inline-flex rounded-md shadow-sm">
        <button href="#" class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-500 hover:bg-blue-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-wave active:bg-blue-700">
            {{ __("menus.report_action") }}
        </button>
    </span>
</nav>
