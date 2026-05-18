<template>
  <div class="flex flex-wrap gap-2 justify-center">
    <div
      v-for="theme in themes"
      :key="theme.id"
      class="relative inline-block px-3 py-2 border-2 cursor-pointer text-xs font-medium leading-5 uppercase rounded-full transition-all duration-200"
      :class="{
        'border-white': isSelected(theme.id),
        'border-gray-100 bg-gray-100 hover:bg-gray-200': !isSelected(theme.id),
      }"
      :style="{
        backgroundColor: isSelected(theme.id) ? theme.color : 'transparent',
      }"
      @click="toggle(theme.id)"
    >
      <span
        class="text-sm transition-colors duration-200"
        :class="{ 'text-white': isSelected(theme.id) }"
      >
        {{ theme.name }}
      </span>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { Theme } from "../../models";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
  themes: {
    type: Array as () => Theme[],
    required: true,
  },
  modelValue: {
    type: Array as () => number[],
    default: () => [],
  },
  multiple: {
    type: Boolean,
    default: true,
  },
});

const isSelected = (id: number): boolean => {
  return props.modelValue.includes(id);
};

const toggle = (id: number) => {
  let newValue: number[];

  if (props.multiple) {
    // Multi-select mode
    if (isSelected(id)) {
      newValue = props.modelValue.filter((themeId) => themeId !== id);
    } else {
      newValue = [...props.modelValue, id];
    }
  } else {
    // Single-select mode
    newValue = isSelected(id) ? [] : [id];
  }

  emit("update:modelValue", newValue);
};
</script>
