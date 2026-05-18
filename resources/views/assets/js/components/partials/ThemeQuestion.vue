<template>
  <div class="p-8">
    <p class="mb-5 text-(--wkid-pink) text-lg md:text-2xl font-thin">
      ActieWijzer
    </p>
    <h1 class="mb-2">{{ props.question.question }}</h1>
    <p class="text-gray-500 text-lg md:text-2xl">
      {{ props.question.description }}
    </p>

    <div class="my-15">
      <ThemeSelector v-model="selected" :themes="themes" />
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref, watch } from "vue";
import type { Question, Theme } from "../../models";
import ThemeSelector from "./ThemeSelector.vue";

const emit = defineEmits(["input"]);

const props = defineProps({
  question: {
    type: Object as () => Question,
    required: true,
  },
  themes: {
    type: Array as () => Theme[],
    required: true,
  },
  value: {
    type: Array as () => number[],
    default: null,
  },
});

const selected = ref([]);

watch(selected, () => {
  emit("input", selected.value);
});

onMounted(() => {
  if (props.value) {
    selected.value = props.value;
  }
});
</script>
