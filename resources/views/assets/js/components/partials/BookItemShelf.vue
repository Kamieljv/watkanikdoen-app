<template>
  <article class="flex cursor-pointer w-60">
    <!-- Book Cover (standing on shelf) -->
    <div
      class="relative w-full aspect-2/3 rounded-sm drop-shadow-lg drop-shadow-gray-400/30"
    >
      <div
        v-if="!imageLoaded"
        class="absolute inset-0 flex items-center justify-center bg-gray-200 text-gray-400 rounded-sm"
      >
        <LogoIcon class="h-8 w-8" style="fill: currentColor" />
      </div>
      <img
        class="w-full h-full object-cover rounded-xs"
        :class="imageLoaded ? 'opacity-100' : 'opacity-0'"
        :src="book.cover_image"
        :alt="book.title"
        @load="imageLoaded = true"
        @error="imageError = true"
      />
    </div>

    <!-- Book Info (below shelf) -->
    <div class="w-full px-2">
      <h3 class="font-semibold text-gray-900 text-sm line-clamp-2 mb-1">
        {{ book.title }}
      </h3>
      <p
        class="text-xs text-gray-500 mb-1"
        v-sanitize.inline="metaDataLine"
      ></p>
      <p
        v-if="book.notes"
        class="text-xs text-gray-600 leading-relaxed line-clamp-3 italic mt-2"
      >
        "{{ book.notes }}"
      </p>
    </div>
  </article>
</template>

<script setup lang="ts">
import { computed, ref } from "vue";
import LogoIcon from "&/logo-icon.svg";
import { BookShelfBook } from "../../models";

const props = defineProps({
  book: {
    type: Object as () => BookShelfBook,
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
