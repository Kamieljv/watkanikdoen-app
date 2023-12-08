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
                    <question :question="currentQuestion" :value="answersGiven[currentQuestion.id]" :key="activeIndex" @input="handleInput" class="p-8 bg-white rounded-md shadow-md min-h-[300px]">
                    </question>
                </Transition>
                <div class="flex mt-5" :class="{'justify-end': activeIndex === 0, 'justify-between': activeIndex > 0}">
                    <button v-if="activeIndex > 0" type="button" @click.prevent="activeIndex--"
                        class="secondary">
                        {{ __('general.previous') }}
                    </button>
                    <button v-if="!isLastStep" class="primary" @click.prevent="activeIndex++">
                        {{ __('general.next') }}
                    </button>
                    <button v-else class="primary"  @click.prevent="submit">
                        {{ __('general.send_form') }}
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
        <p>Answersgiven: {{ answersGiven }}</p>
        <p>Answers: {{ answers }}</p>
        <p>Scores: {{ dimensionScoresNamed}}</p>
        <p>Dimensions: {{ dimensions}}</p>

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
        answers() {
            return this.questions.map((q) => q.answers).flat()
        },
        dimensionScoresNamed() {
            return Object.entries(this.dimension_scores).reduce((a, [k, v]) => ({ ...a, [this.dimensions.find(d => d.id == k).name.toLowerCase()]: v}), {}) 
        }
    },
    methods: {
        handleInput(input) {
            this.$set(this.answersGiven, this.questions[this.activeIndex].id, input);
            this.computeDimensionScores();
        },
        submit() {
            var url = new URL(this.resultRoute);
            url.search = new URLSearchParams(this.dimensionScoresNamed)
            window.location.href = url.href;
        },
        computeDimensionScores() {
            // reset dimension_scores
            this.dimension_scores = {};
            // get full answer objects (with dimensions)
            var answersGivenFull = this.answers.filter((a) => Object.values(this.answersGiven).includes(a.id))
            // sum the dimension scores for each answer
            answersGivenFull.forEach((a) => {
                Object.entries(JSON.parse(a.dimension_scores)).forEach(([k, v]) => {
                    var value = this.dimension_scores.hasOwnProperty(k) ? this.dimension_scores[k] + v : v;
                    this.$set(this.dimension_scores, k, value)
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