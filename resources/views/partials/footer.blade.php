<footer class="bg-gray-700 text-white">
    <div class="px-8 pt-16 mx-auto lg:px-12 xl:px-16 max-w-6xl">
        <div
            class="flex flex-col gap-3 items-center justify-between py-10 border-t border-solid sm:flex-row border-white/50">
            <a id="footer-logo-link" href="{{ route('home') }}">
                @svg('custom-logo-icon', ['style' => 'fill: currentColor; height: 32px;'])
            </a>
            <div class="flex-1 flex items-center justify-center">
                <ul
                    class="flex flex-wrap flex-col sm:gap-y-2 gap-y-3 space-x-0 sm:justify-center sm:flex-row sm:space-x-5 text-xs my-5 sm:my-0">
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
                        <a href="/nieuwsbrief" class="relative inline-block group" style="color: inherit;">
                            <span>{{ __('menus.newsletter') }}</span>
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{ config('app.donate_link') }}" class="relative inline-block group"
                            style="color: inherit;" target="_blank">
                            <span>{{ __('menus.donate') }}</span>
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="/word-vrijwilliger" class="relative inline-block group" style="color: inherit;">
                            <span>{{ __('menus.word_vrijwilliger') }}</span>
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="/contact" class="relative inline-block group" style="color: inherit;">
                            <span>{{ __('menus.contact') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            @include('partials.social-links', ['class' => 'flex items-center space-x-5 lg:mt-0'])
        </div>
    </div>
</footer>

@yield('javascript')