@php
    $type = null;
    $message = null;
    foreach(array('info', 'warning', 'success', 'error') as $messType)
    if (session()->has($messType)) { $type = $messType; $message = session($messType); }
@endphp

@if ($type !== null && $message !== null)
    <div class="fixed inset-0 z-40 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
        <div id="toast"
            x-data="{ show: true }" @click="show = false"
            x-init="setTimeout(() => show = false, 4000); setTimeout(() => $refs.toast_bar.classList.add('w-0'), 10)"
            x-show="show"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="background: var(--wkid-message-{{$type}}-light;"
            class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg cursor-pointer pointer-events-auto hover:-translate-1" x-cloak>
            <div class="relative overflow-hidden rounded-lg shadow-xs">
                <div class="px-4 py-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 pr-0.5" style="color: var(--wkid-message-{{$type}})">
                            @svg('clarity-'.$type.'-standard-solid', ['style' => 'width: 20px; height: 20px'])
                        </div>
                        <div class="flex-1 w-0 pl-3.5 ml-1 border-l border-gray-100">
                            <p class="text-sm font-medium leading-5" style="color: var(--wkid-message-{{$type}}-dark)">
                                <span>{{ __("toast.".$type) }}</span>
                            </p>
                            <p class="text-sm leading-5" style="color: var(--wkid-message-{{$type}}-dark)">{{$message}}</p>
                        </div>
                        <div class="flex self-start flex-shrink-0 ml-4">
                            <button @click="show = false;" class="inline-flex -mt-1 text-gray-400 transition duration-150 ease-in-out rounded-full focus:outline-none focus:text-gray-500">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="toast_bar" x-ref="toast_bar" class="absolute bottom-0 left-0 w-full h-1 transition-all"
                    style="transition-duration: 3950ms; background: var(--wkid-message-{{$type}})"></div>
            </div>
        </div>
    </div>
@endif
