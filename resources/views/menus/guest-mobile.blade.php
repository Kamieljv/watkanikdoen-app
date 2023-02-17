<div x-cloak x-show="mobileMenuOpen" x-transition:enter="duration-300 ease-out scale-100" x-transition:enter-start="opacity-50 scale-110" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition duration-75 ease-in scale-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-100" 
    class="absolute top-2 right-2 left-[20%] sm:min-w-[250px] sm:left-auto shadow-lg rounded-lg overflow-hidden transition origin-top transform lg:hidden">
    <div class="bg-white divide-y-2 shadow-xs divide-gray-50">
        <div class="pt-6 pb-6">
            <div class="absolute right-4 top-4">
                <button @click="mobileMenuOpen = false" type="button" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="mt-8">
                <nav class="grid row-gap-8">
                    <a href="/hoe-werkt-het" class="flex items-center px-8 py-3 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
                        <div class="text-base font-medium leading-6 text-gray-900">
                            {{__('menus.hoe_werkt_het')}}
                        </div>
                    </a>
                    <a href="/word-vrijwilliger" class="flex items-center px-8 py-3 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
                        <div class="text-base font-medium leading-6 text-gray-900">
                            {{__("menus.word_vrijwilliger")}}
                        </div>
                    </a>
                    <a href="{{route('organizers.index')}}" class="flex items-center px-8 py-3 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
                        <div class="text-base font-medium leading-6 text-gray-900">
                            {{__('menus.organizers')}}
                        </div>
                    </a>
                    <a href="/over-ons" class="flex items-center px-8 py-3 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
                        <div class="text-base font-medium leading-6 text-gray-900">
                            {{__('menus.about_us')}}
                        </div>
                    </a>
                    <a href="/contact" class="flex items-center px-8 py-3 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
                        <div class="text-base font-medium leading-6 text-gray-900">
                            {{__("Contact")}}
                        </div>
                    </a>
                </nav>
            </div>
        </div>
        <div class="px-8 pb-6">
            <div class="space-y-3">
                <span class="flex w-full rounded-md shadow-sm">
                    <a href="{{ route('login') }}" class="flex items-center justify-center w-full px-4 py-3 text-base font-medium leading-6 text-blue-600 transition duration-150 ease-in-out border border-transparent rounded-md border-1 border-blue-600 hover:bg-blue-200">
                        {{__("Log In")}}
                    </a>
                </span>
                <span class="flex w-full rounded-md shadow-sm">
                    <a href="{{ route('report.landing') }}" class="flex items-center justify-center w-full px-4 py-3 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500">
                        {{__("menus.report_action")}}
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
