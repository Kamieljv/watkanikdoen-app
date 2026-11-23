{{-- ActieWijzer banner --}}
<div id="actiewijzer-banner-container" class="relative mt-5 md:mx-auto max-w-6xl px-3">
    <div id="actiewijzer-banner"
        class="text-white p-4 md:px-6 rounded-lg flex flex-col sm:flex-row justify-between items-end sm:items-center gap-2 md:gap-0">
        <p class="text-base md:text-lg w-full md:w-auto"><span class="font-bold">Nieuw!</span>&nbsp;
            {!! __('actiewijzer.promo_text') !!}
        </p>
        <a href="/actiewijzer">
            <button class="secondary-white flex items-center hover:translate-x-[0.250rem]"
                data-umami-event="ActieWijzer banner button">
                <p class="text-base sm:text-lg">{{ __('actiewijzer.start') }}</p>
                @svg('custom-arrow-right', 'w-5 h-5 ml-2')
            </button>
        </a>
    </div>
</div>