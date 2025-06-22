<footer class="bg-gray-700 text-white">
    <div class="px-8 pt-16 mx-auto lg:px-12 xl:px-16 max-w-6xl">
        <div class="flex flex-col items-center justify-between py-10 border-t border-solid sm:flex-row border-gray">
            <a id="footer-logo-link" href="{{ route('home') }}">
                @svg('custom-logo-icon', ['style' => 'fill: currentColor; height: 32px;'])
            </a>
            <ul
                class="flex flex-wrap flex-col space-y-3 space-x-0 sm:space-y-0 sm:flex-row sm:space-x-5 text-xs my-5 sm:my-0">
                <li class="text-center flex-full sm:flex-none sm:mb-0">&copy; {{ date('Y') }}
                    {{ config('brand.title') }}</li>
                <li class="text-center">
                    <a href="/algemene-voorwaarden-en-privacyverklaring" class="relative inline-block group"
                        style="color: inherit;">
                        <span>{{ __('Terms and Privacypolicy') }}</span>
                    </a>
                </li>
                <li class="text-center">
                    <a href="/welke-acties-plaatsen-we" class="relative inline-block group" style="color: inherit;">
                        <span>{{ __('menus.welke_acties_plaatsen_we') }}</span>
                    </a>
                </li>
                <li class="text-center">
                    <a href="/over-ons" class="relative inline-block group" style="color: inherit;">
                        <span>{{ __('menus.about_us') }}</span>
                    </a>
                </li>
                <li class="text-center">
                    <a href="https://www.firestarterfund.nl/campaigns/16/demonstratie-agenda-voor-vandaag-en-morgen!-" class="relative inline-block group" style="color: inherit;" target="_blank">
                        <span>{{ __('menus.donate') }}</span>
                    </a>
                </li>
                <li class="text-center">
                    <a href="/contact" class="relative inline-block group" style="color: inherit;">
                        <span>{{ __('Contact') }}</span>
                    </a>
                </li>
            </ul>
            <ul class="flex items-center space-x-5 lg:mt-0">
                <li>
                    <a href="https://www.instagram.com/watkanikdoen.nl/" class="text-white hover:text-gray-400">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://bsky.app/profile/watkanikdoen-nl.bsky.social"
                        class="text-white hover:text-gray-400">
                        <span class="sr-only">Bluesky</span>
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 11.3884C11.0942 9.62673 8.62833 6.34423 6.335 4.7259C4.13833 3.17506 3.30083 3.4434 2.75167 3.69256C2.11583 3.9784 2 4.95506 2 5.52839C2 6.10339 2.315 10.2367 2.52 10.9276C3.19917 13.2076 5.61417 13.9776 7.83917 13.7309C4.57917 14.2142 1.68333 15.4017 5.48083 19.6292C9.65833 23.9542 11.2058 18.7017 12 16.0392C12.7942 18.7017 13.7083 23.7651 18.4442 19.6292C22 16.0392 19.4208 14.2142 16.1608 13.7309C18.3858 13.9784 20.8008 13.2076 21.48 10.9276C21.685 10.2376 22 6.10256 22 5.52923C22 4.95423 21.8842 3.97839 21.2483 3.6909C20.6992 3.44256 19.8617 3.17423 17.665 4.72423C15.3717 6.34506 12.9058 9.62756 12 11.3884Z">
                            </path>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://github.com/Kamieljv/watkanikdoen-app" class="text-white hover:text-gray-400">
                        <span class="sr-only">GitHub</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <div class="flex flex-col items-center justify-center pb-10 sm:flex-row">
            <div>
                <p class="text-xs pb-4">Dit initiatief wordt gesteund door: </p>
                <a id="footer-fnv" href="https://youngandunited.nl">
                    @svg('custom-fnv-yu', ['style' => 'fill: currentColor; height: 50px;'])
                </a>
            </div>
        </div>
    </div>
</footer>

@yield('javascript')
