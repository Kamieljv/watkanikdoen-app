<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ $this->header }}
        </x-slot>
        
        <div class="grid gap-4 md:grid-cols-2">
            @foreach($this->getActions() as $action)
                <a 
                    href="{{ $action['url'] }}" 
                    class="flex items-center gap-3 rounded-lg border border-gray-300 bg-white p-2 shadow-sm transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                    <div class="flex h-12 w-12 items-center justify-center rounded-full text-primary-500 bg-primary-100 dark:bg-primary-900/40">
                        <x-filament::icon 
                            :icon="$action['icon']" 
                            class="h-6 w-6"
                        />
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm text-gray-900 dark:text-white">
                            {{ $action['label'] }}
                        </h3>
                    </div>
                    <x-filament::icon 
                        icon="heroicon-m-chevron-right" 
                        class="h-5 w-5 text-gray-400"
                    />
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
