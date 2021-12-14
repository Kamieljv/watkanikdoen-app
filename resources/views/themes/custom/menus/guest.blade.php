<nav class="flex items-center justify-end flex-1 hidden w-full h-full space-x-10 md:flex">

    <a href="{{ route('wave.blog') }}" class="text-base font-medium leading-6 text-white transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("Blog") }}
    </a>
    
    <a href="{{ route('login') }}" class="text-base font-medium leading-6 text-white whitespace-no-wrap hover:underline focus:outline-none focus:text-gray-900">
        {{ __("Log In") }}
    </a>
    <span class="inline-flex rounded-md shadow-sm">
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-wave-500 hover:bg-wave-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-wave active:bg-wave-700">
            {{ __("Register") }}
        </a>
    </span>
</nav>
