<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Bezoekersstatistieken
        </x-slot>
        
        <x-slot name="description">
            <div class="flex items-center gap-3">
                <span>Laatste {{ $this->days }} dagen vergeleken met de vorige {{ $this->days }} dagen</span>
                <div class="flex gap-2">
                    <button 
                        wire:click="setPeriod(7)"
                        class="rounded-md px-3 py-1 text-sm font-medium transition {{ $this->days === 7 ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}"
                    >
                        7 dagen
                    </button>
                    <button 
                        wire:click="setPeriod(30)"
                        class="rounded-md px-3 py-1 text-sm font-medium transition {{ $this->days === 30 ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}"
                    >
                        30 dagen
                    </button>
                </div>
            </div>
        </x-slot>
        
        <x-slot name="afterHeader">
            <x-filament::link 
                :href="config('umami.url')" 
                target="_blank"
                icon="heroicon-m-arrow-top-right-on-square"
                size="sm"
            >
                More statistics
            </x-filament::link>
        </x-slot>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach($this->getStats() as $key => $stat)
                <div class="rounded-lg p-4 shadow-sm bg-gray-50/50 dark:bg-gray-800">
                    <div class="mb-2">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{ $stat['label'] }}
                        </p>
                    </div>
                    
                    <div class="flex items-baseline gap-2">
                        @if(isset($stat['format']) && $stat['format'] === 'time')
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $this->formatTime($stat['value']) }}
                            </h3>
                        @else
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ is_numeric($stat['value']) ? number_format($stat['value']) : $stat['value'] }}{{ $stat['suffix'] ?? '' }}
                            </h3>
                        @endif
                        
                        @if(is_numeric($stat['change']) && $stat['change'] != 0)
                            @php
                                $isPositive = $stat['change'] > 0;
                                $isInverse = $stat['inverse'] ?? false;
                                $isGood = $isInverse ? !$isPositive : $isPositive;
                            @endphp
                            
                            <span class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-xs font-semibold {{ $isGood ? 'bg-success-100 text-success-700 dark:bg-success-900 dark:text-success-400' : 'bg-danger-100 text-danger-700 dark:bg-danger-900 dark:text-danger-400' }}">
                                @if($isPositive)
                                    <x-filament::icon 
                                        icon="heroicon-m-arrow-trending-up" 
                                        class="h-3 w-3"
                                    />
                                @else
                                    <x-filament::icon 
                                        icon="heroicon-m-arrow-trending-down" 
                                        class="h-3 w-3"
                                    />
                                @endif
                                
                                @if(isset($stat['format']) && $stat['format'] === 'time')
                                    {{ $this->formatTime($stat['change']) }}
                                @else
                                    {{ $isPositive ? '+' : '' }}{{ number_format($stat['change']) }}{{ $stat['suffix'] ?? '' }}
                                @endif
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
