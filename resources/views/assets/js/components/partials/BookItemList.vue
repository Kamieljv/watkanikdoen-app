<template>
  <article
    class="flex flex-col sm:flex-row rounded-lg shadow-lg overflow-hidden cursor-pointer"
  >
    <div class="shrink-0 h-48 w-full sm:w-30 py-2 sm:p-0 bg-gray-300 relative">
      <div
        v-if="!imageLoaded"
        class="absolute inset-0 flex items-center justify-center bg-gray-200 text-gray-400"
      >
        <LogoIcon class="h-12 w-12" style="fill: currentColor" />
      </div>
      <img
        class="w-full h-full object-contain sm:object-cover transition-opacity duration-300"
        :class="imageLoaded ? 'opacity-100' : 'opacity-0'"
        :src="book.cover_image"
        :alt="book.title"
        @load="imageLoaded = true"
        @error="imageError = true"
      />
    </div>
    <div class="bg-white p-4 flex flex-col justify-between min-w-0">
      <div class="flex-1 min-w-0 flex flex-col justify-between">
        <div class="flex flex-col">
          <h3 class="font-semibold text-gray-900">
            {{ book.title }}
          </h3>
          <span
            class="mt-1 text-sm text-gray-500"
            v-sanitize.inline="metaDataLine"
          >
          </span>
          <p class="mt-3 text-sm text-gray-500 leading-5 line-clamp-2">
            {{ book.description }}
          </p>
        </div>
        <div class="flex gap-2 justify-between items-center flex-wrap mt-4">
          <ThemesChips :themes="book.themes" />
          <div class="flex flex-wrap gap-2 mb-1">
            <span
              v-for="tag in book.tag_names"
              :key="tag"
              class="inline-block text-blue-600 text-sm leading-3"
            >
              #{{ tag }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </article>
</template>

<script setup lang="ts">
import { computed, ref } from "vue";
import LogoIcon from "&/logo-icon.svg";

const props = defineProps({
  book: {
    type: Object,
    required: true,
  },
});

const imageLoaded = ref(false);
const imageError = ref(false);

const metaDataLine = computed(() => {
  const parts = [];
  if (book.author) {
    parts.push(book.author);
  }
  if (book.year) {
    parts.push(book.year);
  }
  return parts.join(' <span class="mx-1">|</span> ');
});

const book = props.book;
</script>
