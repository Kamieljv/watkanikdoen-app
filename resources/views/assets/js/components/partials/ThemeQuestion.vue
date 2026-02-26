<template>
  <div class="p-8">
    <p class="mb-5 text-(--wkid-pink) text-lg md:text-2xl font-thin">
      ActieWijzer
    </p>
    <h1 class="mb-2">{{ props.question.question }}</h1>
    <p class="text-gray-500 text-lg md:text-2xl">
      {{ props.question.description }}
    </p>

    <div class="my-5">
      <div
        v-for="t in themes"
        :key="t.id"
        class="relative self-start inline-block px-3 py-2 mr-1 mb-2 border-gray-100 bg-gray-100 cursor-pointer text-xs font-medium leading-5 uppercase rounded-full"
        :class="{
          'border-2 border-white': selected.includes(t.id),
          'border-2': !selected.includes(t.id),
        }"
        :style="{ backgroundColor: selected.includes(t.id) ? t.color : null }"
        :data-id="t.id"
        @click="select(t.id)"
      >
        <span
          class="text-sm"
          :class="{ 'text-white': selected.includes(t.id) }"
          rel="theme"
        >
          {{ t.name }}
        </span>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref, watch } from "vue";
import type { Question, Theme } from "../../models";
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

const select = (id) => {
  if (selected.value.includes(id)) {
    const index = selected.value.indexOf(id);
    selected.value.splice(index, 1);
  } else {
    selected.value.push(id);
  }
};
</script>
