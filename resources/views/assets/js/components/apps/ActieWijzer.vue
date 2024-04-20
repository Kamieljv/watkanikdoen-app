<template>
    <div>
        <div v-if="!sent">
            <step-progress
                :steps="steps"
                :currentStep="activeIndex"
                v-model="activeIndex"
            >
            </step-progress>
            <ValidationObserver>
                <Transition name="slide" mode="out-in" appear>
                    <div v-if="currentQuestion.subject == 'Thema'">
                        <theme-question :question="currentQuestion" :themes="themes" :value="themesSelected" :key="activeIndex" @input="handleThemeInput" class="p-8 bg-white rounded-md shadow-md min-h-[300px]">
                        </theme-question>
                    </div>
                    <div v-else>
                        <question :question="currentQuestion" :value="answersGiven[currentQuestion.id]" :key="activeIndex" @input="handleInput" class="p-8 bg-white rounded-md shadow-md min-h-[300px]">
                        </question>
                    </div>
                </Transition>
                <div class="flex mt-5" :class="{'justify-end': activeIndex === 0, 'justify-between': activeIndex > 0}">
                    <button v-if="activeIndex > 0" type="button" @click.prevent="activeIndex--"
                        class="secondary">
                        {{ __('general.previous') }}
                    </button>
                    <button v-if="isLastStep" class="primary"  @click.prevent="submit">
                        {{ __('general.send_form') }}
                    </button>
                    <button v-else-if="validInput" class="primary" @click.prevent="activeIndex++">
                        {{ __('general.next') }}
                    </button>
                    <button v-else class="primary" disabled>
                        {{ __('general.next') }}
                    </button>
                    
                </div>
            </ValidationObserver>
        </div>
        <div v-else>
            <div class="flex justify-center items-center max-w-4xl mx-auto my-6 bg-white rounded-md shadow-md min-h-[300px]">
                <SuccessGIF src="/images/protest_signs.gif" title="Gelukt! Bedankt voor je bijdrage!" message="We zullen je aanmelding zo snel mogelijk beoordelen."/>
            </div>
        </div>

        <!-- DEBUG -->
        <div class="text-gray-700">
            <p>Answersgiven: {{ answersGiven }}</p>
            <p>Scores: {{ dimension_scores}}</p>
            <p>Themes: {{ themesSelected }}</p>
        </div>

    </div>
</template>

<script>

import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "ActieWijzer",
    mixins: [
        caseHelper,
    ],
    props: {
        questions: {
            type: Array,
            required: true,
        },
        dimensions: {
            type: Array,
            required: true,
        },
        themes: {
            type: Array,
            required: true,
        },
        resultRoute: {
            type: String,
            required: true,
        }
    },
    data: () => ({
        activeIndex: 0,
        sent: false,
        currentErrors: [],
        answersGiven: {},
        dimension_scores: {},
        themesSelected: [],
    }),
    computed: {
        steps() {
            return this.questions.map(q => q.subject)
        },
        activeStep() {
            return this.steps[this.activeIndex]
        },
        isLastStep() {
            return this.activeIndex === this.steps.length - 1;
        },
        currentQuestion() {
            return this.questions[this.activeIndex];
        },
        validInput() {
            if (this.questions[this.activeIndex].subject == 'Thema') {
                return this.themesSelected.length > 0
            }
            return true
        },
        answers() {
            return this.questions.map((q) => q.answers).flat()
        },
    },
    methods: {
        handleInput(input) {
            this.$set(this.answersGiven, this.questions[this.activeIndex].id, input);
            this.computeDimensionScores();
        },
        handleThemeInput(input) {
            this.themesSelected = input
        },
        submit() {
            var dimension_scores_avg = {};
            Object.keys(this.dimension_scores).forEach(k => {
                dimension_scores_avg[k] = this.dimension_scores[k].reduce((a, b) => a + b, 0) / this.dimension_scores[k].length
            });
            var url = new URL(this.resultRoute);
            var url_params = new URLSearchParams(dimension_scores_avg)
            this.themesSelected.forEach(id => url_params.append('themes[]', id))
            url.search = url_params
            window.location.href = url.href;
        },
        computeDimensionScores() {
            // reset dimension_scores
            this.dimension_scores = {};
            // get full answer objects (with dimensions)
            var answersGivenFull = this.answers.filter((a) => Object.values(this.answersGiven).includes(a.id))
            // sum the dimension scores for each answer
            answersGivenFull.forEach((a) => {
                a.dimensions.forEach((d) => {
                    var newValue = this.dimension_scores.hasOwnProperty(d.name) ? this.dimension_scores[d.name].concat([d.pivot.score]) : [d.pivot.score];
                    this.$set(this.dimension_scores, d.name, newValue)
                })
            });
        }
    },
}; 
</script>
<style scoped>
    h2 {
        @apply mb-3;
    }
    
    .slide-enter-active {
        transition: all 0.5s ease-in-out;
    }
    .slide-leave-active {
        transition: all 0.5s ease-in-out;
    }

    .slide-enter-from {
        opacity: 0;
    }

    .slide-leave-to {
        opacity: 0;
    }
    .failure {
        color: var(--wkid-message-error-dark);
        background: var(--wkid-message-error-light);
    }
</style>