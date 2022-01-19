<nav class="flex items-center justify-end flex-1 w-full h-full space-x-10">

    <a href="{{ route('wave.blog') }}" class="hidden lg:block text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("Blog") }}
    </a>
    <a href="/over-ons" class="hidden lg:block text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("general.about_us") }}
    </a>
    <a href="/contact" class="hidden lg:block text-base font-medium leading-6 transition duration-150 ease-in-out hover:underline focus:outline-none focus:text-wave-600">
        {{ __("Contact") }}
    </a>
    
    <span class="inline-flex rounded-md shadow-sm">
        <button href="#" class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-500 hover:bg-blue-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-wave active:bg-blue-700">
            {{ __("menus.report_action") }}
        </button>
    </span>

    <div class="flex sm:relative sm:ml-6 items-center">

        <div class="flex justify-end flex-grow -my-2 -mr-2 lg:hidden">
            <button @click="mobileMenuOpen = true" type="button" class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                <svg class="w-6 h-6" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
            </button>
        </div>

        @include('theme::partials.notifications')

        <!-- Profile dropdown -->
        <div id="profile-dropdown" @click.away="open = false" class="flex items-center h-full ml-3" x-data="{ open: false }">
            <div>
                <button @click="open = !open" class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 hover:border-gray-300" id="user-menu" aria-label="User menu" aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
                    <img class="w-10 h-10 rounded-full" src="{{ auth()->user()->avatar_path . '?' . time() }}" alt="{{ auth()->user()->name }}'s Avatar">
                </button>
            </div>

            <div
                x-show="open"
                x-transition:enter="duration-100 ease-out scale-95"
                x-transition:enter-start="opacity-50 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition duration-50 ease-in scale-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute top-0 right-2 sm:right-0 w-56 mt-[70px] sm:mt-[50px] origin-top-right text-gray-700 transform rounded-xl" x-cloak>

                <div class="bg-white border border-gray-100 drop-shadow-xl rounded-xl" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="block px-4 py-3 text-gray-700">
                        <span class="block text-sm font-medium leading-tight truncate">
                            {{__("menus.hello")}}, {{ auth()->user()->name }}!
                        </span>
                    </div>
                    @impersonating
                            <a href="{{ route('impersonate.leave') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 text-blue-900 border-t border-gray-100 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:bg-blue-200">{{ __("Leave") }} {{ __("general.impersonation") }}</a>
                    @endImpersonating
                    <div class="border-t border-gray-100"></div>
                    <div class="py-1">

                        <div class="block px-4 py-1">
                            <span class="inline-block px-2 my-1 -ml-1 text-xs font-medium leading-5 text-gray-600 bg-gray-200 rounded">
                                {{ auth()->user()->role->display_name }}
                            </span>
                        </div>
                        @if( !auth()->guest() && auth()->user()->can('browse_admin') )
                            <a href="{{ route('voyager.dashboard') }}" class="flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900">
                                @svg('antdesign-thunderbolt-o', ['style' => 'width: 20px; height: 20px']) &nbsp; Admin
                            </a>
                        @endif
                        <a href="{{ route('wave.settings') }}" class="flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900">
                            @svg('antdesign-setting-o', ['style' => 'width: 20px; height: 20px']) &nbsp; {{ __("menus.settings")}}
                        </a>

                    </div>
                    <div class="border-t border-gray-100"></div>
                    <div class="py-1">
                        <a href="{{ route('wave.logout') }}" class="flex items-center w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">
                            @svg('antdesign-logout-o', ['style' => 'width: 20px; height: 20px']) &nbsp; {{ __("Log Out") }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</nav>
