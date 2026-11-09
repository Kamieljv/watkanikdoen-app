<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
        state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
        dimensions: @js($getDimensions()),
        minScore: {{ $getMinScore() }},
        maxScore: {{ $getMaxScore() }},
        initialScores: @js($getScores()),

        init() {
            // Initialize from state if available, otherwise from initialScores
            if (this.state && typeof this.state === 'object' && Object.keys(this.state).length > 0) {
                this.scores = this.initializeScores(this.state);
            } else if (this.initialScores && Object.keys(this.initialScores).length > 0) {
                this.scores = this.initializeScores(this.initialScores);
            } else {
                this.scores = this.initializeScores();
            }
            
            // Watch for changes in scores and sync back to state
            this.$watch('scores', (value) => {
                this.state = { ...value };
            }, { deep: true });

            // Watch for external state changes
            this.$watch('state', (value) => {
                if (value && typeof value === 'object') {
                    const currentJson = JSON.stringify(this.scores);
                    const newJson = JSON.stringify(value);
                    if (currentJson !== newJson) {
                        this.scores = this.initializeScores(value);
                    }
                }
            });
        },

        initializeScores(existingScores = {}) {
            const scores = {};
            this.dimensions.forEach(dim => {
                let existing = null;
                
                if (existingScores && typeof existingScores === 'object') {
                    existing = existingScores[dim.id];
                }
                
                scores[dim.id] = existing !== null && existing !== undefined ? parseInt(existing) : this.minScore;
            });
            return scores;
        },
    }">
        <!-- Dimension Scores -->
        <div class="rounded-lg p-4 bg-gray-100 dark:bg-gray-800">
            <div class="space-y-3">
                <template x-for="dimension in dimensions" :key="dimension.id">
                    <div class="flex items-center gap-3">
                        <label class="text-sm text-gray-600 dark:text-gray-400 w-40 flex-shrink-0" x-text="dimension.name"></label>
                        <input 
                            type="range"
                            :min="minScore"
                            :max="maxScore"
                            x-model.number="scores[dimension.id]"
                            class="dimension-slider flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                        />
                        <input 
                            type="number"
                            :min="minScore"
                            :max="maxScore"
                            x-model.number="scores[dimension.id]"
                            class="w-20 fi-input text-center"
                        />
                    </div>
                </template>
            </div>
        </div>
    </div>
</x-dynamic-component>
