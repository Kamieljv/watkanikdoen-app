<template>
  <div class="p-8">
    <p class="mb-5 text-(--wkid-pink) text-lg md:text-2xl font-thin">
      ActieWijzer
    </p>
    <h1 class="mb-2">{{ question.question }}</h1>
    <p class="text-gray-500 text-lg md:text-2xl">{{ question.description }}</p>
    <div class="flex flex-col flex-wrap gap-1 mt-5">
      <div
        v-for="answer in answers"
        :key="answer.id"
        class="flex items-center gap-2"
      >
        <RadioButton
          v-model="data"
          :input-id="'answer' + answer.id"
          name="dynamic"
          :value="answer.id"
        />
        <label :for="'answer' + answer.id" class="cursor-pointer">{{
          answer.answer
        }}</label>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import RadioButton from "primevue/radiobutton";
import { ref, watch, computed } from "vue";
const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
  question: {
    type: Object,
    required: true,
  },
  value: {
    type: Number,
    default: null,
  },
});

const data = ref(props.value);

const answers = computed(() => {
  return props.question.answers;
});

watch(data, (data) => {
  emit("update:modelValue", data);
});
</script>
