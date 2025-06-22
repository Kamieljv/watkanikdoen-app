{{-- ActieWijzer banner --}}
<div id="actiewijzer-banner-container" class="relative mt-5 md:mx-auto max-w-6xl">
    <div id="actiewijzer-banner"
        class="text-white p-4 md:px-6 rounded-lg flex flex-col sm:flex-row justify-between items-end sm:items-center gap-2 md:gap-0">
        <p class="text-base md:text-lg w-full md:w-auto"><span class="font-bold">Nieuw!</span>&nbsp;
            {!! __('actiewijzer.promo_text') !!}</p>
        <a href="/actiewijzer">
            <button class="secondary-white flex items-center hover:translate-x-[0.250rem]" data-umami-event="ActieWijzer banner button">
                <p class="text-base sm:text-lg">{{ __('actiewijzer.start') }}</p>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 mr-2 ml-1" style="transform: rotate(180deg);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </button>
        </a>
    </div>
</div>
