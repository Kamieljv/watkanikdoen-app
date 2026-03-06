<template>
  <div>
    <div v-if="!started">
      <div
        class="flex flex-col justify-between max-w-6xl mx-auto my-6 p-8 bg-white rounded-md shadow-md min-h-[400px]"
      >
        <div>
          <h1 class="mb-1">{{ __("actiewijzer.title") }}</h1>
          <p class="text-gray-700 text-lg mt-2 md:mt-3 md:text-2xl">
            {{ __("actiewijzer.description") }}
          </p>
        </div>
        <div>
          <div
            v-if="urlFromStorage"
            class="flex flex-col md:flex-row gap-3 justify-between items-end md:items-center bg-blue-200 p-3 mt-8 md:mt-0 mb-4 rounded-md"
          >
            <p class="text-gray-800">
              {{ __("actiewijzer.previous_result_detected") }}
            </p>
            <a :href="urlFromStorage">
              <button class="secondary">
                {{ __("actiewijzer.previous_result_link") }}
              </button>
            </a>
          </div>
          <div class="flex justify-end mt-5 flex-wrap flex-col md:flex-row">
            <p class="flex items-center p-1 md:p-3 text-sm text-gray-500 gap-1">
              <ShieldIcon class="w-5 h-5" />
              {{ __("actiewijzer.privacy_notice") }}
            </p>
            <p class="flex items-center p-1 md:p-3 text-sm text-gray-500 gap-1">
              <ClockIcon class="w-5 h-5" />
              {{ __("actiewijzer.fill_in_time") }}
            </p>
            <button
              class="primary items-center hover:translate-x-[0.250rem] mt-3 md:mt-0"
              tabindex="0"
              @click="started = true"
            >
              <p class="text-lg">{{ __("actiewijzer.start") }}</p>
              <svg
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 mr-2 ml-1"
                style="transform: rotate(180deg)"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M10 19l-7-7m0 0l7-7m-7 7h18"
                ></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <step-progress
        v-model="activeIndex"
        :steps="steps"
        :current-step="activeIndex"
      >
      </step-progress>
      <Form>
        <Transition name="slide" mode="out-in" appear>
          <theme-question
            v-if="currentQuestion.subject == themeStepName"
            :key="'theme-' + activeIndex"
            :question="currentQuestion"
            :themes="themes"
            :value="themesSelected"
            class="p-8 bg-white rounded-md shadow-md min-h-[400px]"
            @input="handleThemeInput"
          >
          </theme-question>
          <question
            v-else
            :key="'question-' + activeIndex"
            :question="currentQuestion"
            :value="answersGiven[currentQuestion.id]"
            class="p-8 bg-white rounded-md shadow-md min-h-[400px]"
            @update:model-value="handleInput"
          >
          </question>
        </Transition>
        <div
          class="flex mt-5"
          :class="{
            'justify-end': activeIndex === 0,
            'justify-between': activeIndex > 0,
          }"
        >
          <button
            v-if="activeIndex > 0"
            type="button"
            tabindex="0"
            class="secondary"
            @click.prevent="activeIndex--"
          >
            {{ __("general.previous") }}
          </button>
          <div v-if="isLastStep" class="flex space-x-3">
            <span
              v-if="showValidation && !canSubmit"
              class="flex items-center italic"
              >{{ __("actiewijzer.answer_question_before_proceed_any") }}</span
            >
            <button
              class="primary"
              :disabled="!canSubmit"
              tabindex="0"
              @click.prevent="submit"
              @mouseover="showValidation = true"
              @mouseleave="showValidation = false"
            >
              {{ __("general.send_form") }}
            </button>
          </div>
          <button
            v-else-if="validInput"
            class="primary"
            tabindex="0"
            @click.prevent="activeIndex++"
          >
            {{ __("general.next") }}
          </button>
          <div v-else class="flex space-x-3">
            <span v-if="showValidation" class="flex items-center italic">{{
              __("actiewijzer.answer_question_before_proceed_single")
            }}</span>
            <button
              class="primary"
              disabled
              @mouseover="showValidation = true"
              @mouseleave="showValidation = false"
            >
              {{ __("general.next") }}
            </button>
          </div>
        </div>
      </Form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Form } from "vee-validate";
import { computed, inject, onMounted, ref } from "vue";
import ClockIcon from "&/antdesign-clock-circle-o.svg";
import ShieldIcon from "&/clarity-shield-check-solid.svg";
import type { Answer, Dimension, Question, Theme } from "../../models";

const __: (key: string) => string = inject("translate");

const props = defineProps({
  questions: {
    type: Array<Question>,
    required: true,
  },
  dimensions: {
    type: Array<Dimension>,
    required: true,
  },
  themes: {
    type: Array<Theme>,
    required: true,
  },
  resultRoute: {
    type: String,
    required: true,
  },
  themeStepName: {
    type: String,
    default: "Thema",
  },
});

const activeIndex = ref(0);
const started = ref(false);
const showValidation = ref(false);
const answersGiven = ref({});
const dimension_scores = ref({});
const themesSelected = ref([]);

const urlFromStorage = localStorage.getItem("actiewijzer_result_url");

const steps = computed(() => props.questions.map((q: Question) => q.subject));

const isLastStep = computed(() => activeIndex.value === steps.value.length - 1);

const currentQuestion = computed(() => props.questions[activeIndex.value]);

const validInput = computed(() => {
  if (props.questions[activeIndex.value].subject === props.themeStepName) {
    return themesSelected.value.length > 0;
  }
  return true;
});

const answers = computed(() =>
  props.questions.map((q: Question) => q.answers).flat(),
);

const canSubmit = computed(
  () =>
    Object.keys(answersGiven.value).length > 0 &&
    themesSelected.value.length > 0,
);

onMounted(() => {
  props.dimensions.forEach((dim: Dimension) => {
    dim.maxScore = props.questions
      .map((q: Question) => {
        const maxScore = Math.max(
          ...q.answers
            .map((a: Answer) =>
              a.dimensions
                .filter((d: Dimension) => d.name == dim.name)
                .map((d) => d.pivot.score),
            )
            .flat(),
        );
        return maxScore === -Infinity ? 0 : maxScore;
      })
      .reduce((a, b) => a + b, 0);
  });
});

const handleInput = (input) => {
  answersGiven.value[props.questions[activeIndex.value].id] = input;
  computeDimensionScores();
};

const handleThemeInput = (input) => {
  themesSelected.value = input;
};

const submit = () => {
  const dimension_scores_avg = {};
  Object.keys(dimension_scores.value).forEach((k) => {
    dimension_scores_avg[k] = Math.round(
      (dimension_scores.value[k].reduce((a, b) => a + b, 0) /
        props.dimensions.find((d) => d.name == k).maxScore) *
        10,
    );
  });
  const url = new URL(props.resultRoute);
  const url_params = new URLSearchParams(dimension_scores_avg);
  themesSelected.value.forEach((id) => url_params.append("themes[]", id));
  url.search = url_params.toString();
  window.location.href = url.href;
};

const computeDimensionScores = () => {
  dimension_scores.value = {};
  const answersGivenFull = answers.value.filter((a) =>
    Object.values(answersGiven.value).includes(a.id),
  );
  answersGivenFull.forEach((a) => {
    a.dimensions.forEach((d) => {
      const newValue = Object.prototype.hasOwnProperty.call(
        dimension_scores.value,
        d.name,
      )
        ? dimension_scores.value[d.name].concat([d.pivot.score])
        : [d.pivot.score];
      dimension_scores.value[d.name] = newValue;
    });
  });
};
</script>
<style scoped>
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
