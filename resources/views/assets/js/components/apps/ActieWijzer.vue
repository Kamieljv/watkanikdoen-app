<template>
    <div>
        <div v-if="!started">
            <div class="flex flex-col justify-between max-w-6xl mx-auto my-6 p-8 bg-white rounded-md shadow-md min-h-[400px]">
                <div>
                    <h1 class="mb-1">Doe de ActieWijzer!</h1>
                    <h3 class="font-normal text-gray-500">{{ __('actiewijzer.description') }}</h3>
                </div>
                <div>
                    <div v-if="urlFromStorage" class="flex justify-between items-center bg-blue-200 p-3 mb-4 rounded-md">
                        {{ __('actiewijzer.previous_result_detected') }}
                        <a :href="urlFromStorage">
                            <button class="secondary">{{ __('actiewijzer.previous_result_link') }}</button>
                        </a>
                    </div>
                    <div class="flex justify-end">
                        <p class="flex items-center p-3 text-sm text-gray-500 gap-1">
                            <ClockIcon class="w-5 h-5" />
                            {{ __('actiewijzer.fill_in_time') }}
                        </p>
                        <button @click="started = true" class="primary items-center hover:translate-x-[0.250rem]" tabindex="0">
                            <p class="text-lg">{{__('actiewijzer.start')}}</p>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 ml-1" style="transform: rotate(180deg);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <step-progress
                :steps="steps"
                :currentStep="activeIndex"
                v-model="activeIndex"
            >
            </step-progress>
            <Form>
                <Transition name="slide" mode="out-in" appear>
                    <theme-question v-if="currentQuestion.subject == themeStepName" :question="currentQuestion" :themes="themes" :value="themesSelected" :key="activeIndex" @input="handleThemeInput" class="p-8 bg-white rounded-md shadow-md min-h-[400px]">
                    </theme-question>
                    <question v-else :question="currentQuestion" :value="answersGiven[currentQuestion.id]" :key="activeIndex" @update:modelValue="handleInput" class="p-8 bg-white rounded-md shadow-md min-h-[400px]">
                    </question>
                </Transition>
                <div class="flex mt-5" :class="{'justify-end': activeIndex === 0, 'justify-between': activeIndex > 0}">
                    <button v-if="activeIndex > 0" type="button" @click.prevent="activeIndex--" tabindex="0"
                        class="secondary">
                        {{ __('general.previous') }}
                    </button>
                    <div v-if="isLastStep" class="flex space-x-3">
                        <span v-if="showValidation && !canSubmit" class="flex items-center italic">{{ __('actiewijzer.answer_question_before_proceed_any') }}</span>
                        <button class="primary"  @click.prevent="submit" :disabled="!canSubmit" @mouseover="showValidation = true" @mouseleave="showValidation = false" tabindex="0">
                            {{ __('general.send_form') }}
                        </button>
                    </div>
                    <button v-else-if="validInput" class="primary" @click.prevent="activeIndex++" tabindex="0">
                        {{ __('general.next') }}
                    </button>
                    <div v-else class="flex space-x-3">
                        <span v-if="showValidation" class="flex items-center italic">{{ __('actiewijzer.answer_question_before_proceed_single') }}</span>
                        <button class="primary" disabled @mouseover="showValidation = true" @mouseleave="showValidation = false">
                            {{ __('general.next') }}
                        </button>
                    </div>
                    
                </div>
            </Form>
        </div>
    </div>
</template>

<script setup lang="ts">

import { Form } from 'vee-validate';
import { computed, inject, onMounted, ref } from 'vue';
import ClockIcon from '&/antdesign-clock-circle-o.svg';
const __ = inject('translate');

const props = defineProps({
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
    },
    themeStepName: {
        type: String,
        default: 'Thema',
    }
})

const activeIndex = ref(0);
const started = ref(false);
const showValidation = ref(false);
const currentErrors = ref([]);
const answersGiven = ref({});
const dimension_scores = ref({});
const themesSelected = ref([]);

const urlFromStorage = localStorage.getItem('actiewijzer_result_url');

const steps = computed(() => props.questions.map(q => q.subject));

const isLastStep = computed(() => activeIndex.value === steps.value.length - 1);

const currentQuestion = computed(() => props.questions[activeIndex.value]);

const validInput = computed(() => {
    if (props.questions[activeIndex.value].subject === props.themeStepName) {
        return themesSelected.value.length > 0;
    }
    return true;
});

const answers = computed(() => props.questions.map((q) => q.answers).flat());

const canSubmit = computed(() => Object.keys(answersGiven.value).length > 0 && themesSelected.value.length > 0);

onMounted(() => {
    props.dimensions.forEach((dim) => {
        dim.maxScore = props.questions.map(q => {
            let maxScore = Math.max(
                ...q.answers.map(a => a.dimensions.filter(d => d.name == dim.name).map(d => d.pivot.score)).flat()
            ) 
            return maxScore === -Infinity ? 0 : maxScore
        }).reduce((a, b) => a + b, 0);
    });
});

const handleInput = (input) => {
    answersGiven.value[props.questions[activeIndex.value].id] = input;
    computeDimensionScores();
}

const handleThemeInput = (input) => {
    themesSelected.value = input;
}

const submit = () => {
    const dimension_scores_avg = {};
    Object.keys(dimension_scores.value).forEach(k => {
        dimension_scores_avg[k] = Math.round(dimension_scores.value[k].reduce((a, b) => a + b, 0) / props.dimensions.find(d => d.name == k).maxScore * 10)
    });
    const url = new URL(props.resultRoute);
    const url_params = new URLSearchParams(dimension_scores_avg)
    themesSelected.value.forEach(id => url_params.append('themes[]', id))
    url.search = url_params
    window.location.href = url.href;
}

const computeDimensionScores = () => {
    dimension_scores.value = {};
    const answersGivenFull = answers.value.filter((a) => Object.values(answersGiven.value).includes(a.id))
    answersGivenFull.forEach((a) => {
        a.dimensions.forEach((d) => {
            const newValue = dimension_scores.value.hasOwnProperty(d.name) ? dimension_scores.value[d.name].concat([d.pivot.score]) : [d.pivot.score];
            dimension_scores.value[d.name] = newValue;
        })
    });
}

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