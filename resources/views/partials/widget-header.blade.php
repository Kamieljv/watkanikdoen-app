<header id="header" class="fixed inset-x-0 top-0 text-white z-30 transition-all duration-100 bg-[color:var(--wkid-pink)]">
    <div class="px-3 md:px-8 mx-auto xl:px-0 max-w-6xl border-b-1 border-[#cecece8c]">
        <div class="flex items-center justify-center h-16 md:h-24 md:space-x-6">
            <div class="inline-flex h-5/6">
                <a id="header-logo-link" href="{{ route('home') }}" target="_blank" class="inline-flex h-full w-full items-center justify-start transition-all duration-1000 ease-out transform text-white">
                    @svg('custom-logo-full', ['style' => 'fill: currentColor; height: 100%; width: auto;'])
                </a>
            </div>
        </div>
    </div>
</header>
