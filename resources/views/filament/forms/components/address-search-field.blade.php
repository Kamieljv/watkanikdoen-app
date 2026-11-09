<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div 
        class="fi-input-wrp fi-fo-text-input relative overflow-visible"
        x-data="{ 
            suggestions: [],
            showSuggestions: false,
            searchAddress(query) {
                if (query.length < 3) {
                    this.suggestions = [];
                    this.showSuggestions = false;
                    return;
                }
                
                fetch(`https://api.pdok.nl/bzk/locatieserver/search/v3_1/suggest?q=${encodeURIComponent(query)}&rows=5&fl=id,weergavenaam&fq=type:adres`)
                    .then(response => response.json())
                    .then(data => {
                        this.suggestions = Object.keys(data.highlighting).map(key => ({
                            id: key,
                            name: data.highlighting[key].suggest[0].replace(/<\/?[^>]+(>|$)/g, '')
                        }));
                        this.showSuggestions = true;
                    });
            },
            selectAddress(id, name) {
                this.$wire.set('{{ $getStatePath() }}', name);
                this.showSuggestions = false;
                
                fetch(`https://api.pdok.nl/bzk/locatieserver/search/v3_1/lookup?id=${id}&fl=centroide_ll`)
                    .then(response => response.json())
                    .then(data => {
                        const pointString = data.response.docs[0].centroide_ll;
                        const coords = pointString.slice(6, pointString.length - 1).split(' ');
                        const lat = parseFloat(coords[1]);
                        const lng = parseFloat(coords[0]);
                        
                        // Set location and force a refresh
                        this.$wire.set('data.location', { lat: lat, lng: lng }).then(() => {
                            // Force Livewire to refresh after state is set
                            this.$wire.dispatch('refreshMap');
                        });
                    });
            }
        }"
    >
        <input
            {!! $applyStateBindingModifiers('wire:model') !!}="{{ $getStatePath() }}"
            type="text"
            class="fi-input"
            x-on:input.debounce.500ms="searchAddress($event.target.value)"
            @if ($isDisabled()) disabled @endif
            @if ($placeholder = $getPlaceholder()) placeholder="{{ $placeholder }}" @endif
            @if ($isRequired()) required @endif
            @if ($getMaxLength()) maxlength="{{ $getMaxLength() }}" @endif
            id="{{ $getId() }}"
            autocomplete="off"
        />
        
        <!-- Suggestions dropdown -->
        <div 
            x-show="showSuggestions && suggestions.length > 0"
            x-cloak
            class="absolute z-2000 mt-10 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-auto"
        >
            <template x-for="suggestion in suggestions" :key="suggestion.id">
                <div
                    x-text="suggestion.name"
                    @click="selectAddress(suggestion.id, suggestion.name)"
                    class="px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 text-sm text-gray-900 dark:text-gray-100"
                ></div>
            </template>
        </div>
    </div>
</x-dynamic-component>
