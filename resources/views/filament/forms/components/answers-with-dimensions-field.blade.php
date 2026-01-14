<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
        state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
        dimensions: @js($getDimensions()),
        minScore: {{ $getMinScore() }},
        maxScore: {{ $getMaxScore() }},
        answers: [],

        init() {
            // Initialize from state
            if (Array.isArray(this.state) && this.state.length > 0) {
                this.answers = this.state.map(answer => ({
                    id: answer.id || null,
                    answer: answer.answer || '',
                    dimensions: this.initializeDimensions(answer.dimensions)
                }));
            }

            // Watch for changes in answers and sync back to state
            this.$watch('answers', (value) => {
                // Filter out answers with empty text before syncing
                const validAnswers = value.filter(answer => answer.answer && answer.answer.trim() !== '');
                this.state = validAnswers.map(answer => ({
                    id: answer.id,
                    answer: answer.answer,
                    dimensions: answer.dimensions
                }));
            }, { deep: true });

            // Watch for external state changes
            this.$watch('state', (value) => {
                if (Array.isArray(value) && value.length > 0) {
                    const currentJson = JSON.stringify(this.answers.map(a => ({ id: a.id, answer: a.answer, dimensions: a.dimensions })));
                    const newJson = JSON.stringify(value);
                    if (currentJson !== newJson) {
                        this.answers = value.map(answer => ({
                            id: answer.id || null,
                            answer: answer.answer || '',
                            dimensions: this.initializeDimensions(answer.dimensions)
                        }));
                    }
                }
            });
        },

        initializeDimensions(existingDimensions = {}) {
            const dims = {};
            this.dimensions.forEach(dim => {
                let existing = null;
                
                if (existingDimensions && typeof existingDimensions === 'object') {
                    existing = existingDimensions[dim.id];
                }
                
                dims[dim.id] = existing !== null && existing !== undefined ? parseInt(existing) : this.minScore;
            });
            return dims;
        },

        addAnswer() {
            this.answers.push({
                id: null,
                answer: '',
                dimensions: this.initializeDimensions()
            });
        },

        removeAnswer(index) {
            this.answers.splice(index, 1);
        },
    }">
        <!-- Debug info (remove after testing) -->
        <div x-show="false" x-text="'Answers count: ' + answers.length"></div>
        
        <!-- Answers List -->
        <div class="space-y-4" x-show="answers.length > 0">
            <template x-for="(answer, index) in answers" :key="answer.id || 'new-' + index">
                <div class="rounded-lg p-4 bg-gray-100 dark:bg-gray-800">
                    <!-- Answer Text Input -->
                    <div class="flex gap-2">
                        <div class="fi-input-wrp flex-1">
                            <input 
                                type="text"
                                x-model="answer.answer"
                                class="fi-input"
                                :class="{ 'border-danger-600 focus:border-danger-600 focus:ring-danger-600': !answer.answer || answer.answer.trim() === '' }"
                                placeholder="Answer text"
                                required
                            />
                        </div>
                        <button 
                            type="button"
                            @click="removeAnswer(index)"
                            class="ml-2 hover:text-danger-800 focus:outline-none"
                            title="Remove Answer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <p x-show="!answer.answer || answer.answer.trim() === ''" class="mt-1 text-sm text-danger-600">
                        Answer text is required
                    </p>

                    <!-- Dimension Scores -->
                    <label class="block mt-3 mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Dimension Scores</label>

                    <div class="space-y-2">
                        <template x-for="dimension in dimensions" :key="dimension.id">
                            <div class="flex items-center gap-3">
                                <label class="text-sm text-gray-600 dark:text-gray-400 w-32" x-text="dimension.name"></label>
                                <input 
                                    type="range"
                                    :min="minScore"
                                    :max="maxScore"
                                    x-model.number="answer.dimensions[dimension.id]"
                                    class="dimension-slider flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                                />
                                <input 
                                    type="number"
                                    :min="minScore"
                                    :max="maxScore"
                                    x-model.number="answer.dimensions[dimension.id]"
                                    class="w-20 fi-input text-center"
                                />
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty state -->
        <div x-show="answers.length === 0" class="text-sm text-gray-500 dark:text-gray-400 py-4">
            No answers yet. Click "Add Answer" to create one.
        </div>

        <!-- Add Answer Button -->
        <button 
            type="button"
            @click="addAnswer"
            class="mt-4 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
        >
            + Add Answer
        </button>
    </div>
</x-dynamic-component>
