<template>
  <div :class="['relative aspect-213/320', customClass]">
    <div
      v-if="!imageLoaded"
      class="absolute inset-0 flex items-center justify-center bg-gray-200 text-gray-400 rounded-sm"
    >
      <LogoIcon class="h-8 w-8 sm:h-12 sm:w-12" style="fill: currentColor" />
    </div>
    <img
      :class="[
        'w-full h-full rounded-sm transition-opacity duration-300',
        imageLoaded ? 'opacity-100' : 'opacity-0',
        objectFit,
      ]"
      :src="coverImage"
      :alt="title"
      @load="imageLoaded = true"
      @error="imageError = true"
    />
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import LogoIcon from "&/logo-icon.svg";

const props = defineProps({
  coverImage: {
    type: String,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
  class: {
    type: String,
    default: "",
  },
  objectFit: {
    type: String,
    default: "object-cover",
    validator: (value: string) =>
      ["object-cover", "object-contain"].includes(value),
  },
});

const customClass = props.class;
const imageLoaded = ref(false);
const imageError = ref(false);
</script>
