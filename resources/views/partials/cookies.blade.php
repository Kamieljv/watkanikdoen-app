

<div class="fixed inset-x-0 bottom-0 z-[1002] flex items-end justify-center px-4 py-6 sm:p-6 sm:items-start sm:justify-start">
    <div id="cookie-consent" class="hidden w-full p-6 bg-white text-gray-800 rounded-xl shadow-[0_9px_25px_0_rgba(0,0,0,0.3)] border-gray-400">
        <h3 class="mb-5">
            @svg('custom-phosphor-cookie-light', ['style' => 'fill: currentColor; height: 32px; width: auto; display: inline;'])
            We gebruiken cookies
        </h3>
        <div class="mb-2 flex justify-between">
            <div>
                We gebruiken uitsluitend functionele en analytische cookies (die u niet kunt weigeren) en delen geen data met derden.
                Lees meer over onze cookies in de
                <a href="/voorwaarden-en-privacyverklaring" target="_blank" class="font-bold hover:underline">Voorwaarden en Privacyverklaring</a>.
                Bij bezoek aan deze website gaat u hiermee akkoord.
            </div>
            <button id="acceptCookies" class="hidden md:block px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-gray-700 hover:bg-gray-900">
                Oké
            </button>
        </div>
        <div class="mt-5 flex justify-end space-x-3">
            <button id="acceptCookies" class="block md:hidden px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-gray-700 hover:bg-gray-900">
                Oké
            </button>
            {{-- <button id="rejectCookies" class="px-4 py-2 text-base font-medium leading-6 text-gray-800 whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-gray-200 hover:bg-gray-300">
                Weigeren
            </button> --}}
        </div>
    </div>
    {{-- <div id="cookie-edit" class="hidden p-4 bg-white text-gray-800 cursor-pointer rounded-xl shadow-[0_9px_25px_0_rgba(0,0,0,0.3)] border-gray-400" title="Cookievoorkeur wijzigen">
        @svg('custom-phosphor-cookie-light', ['style' => 'fill: currentColor; height: 32px;'])
    </div> --}}
</div>