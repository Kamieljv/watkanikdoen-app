<template>
  <article class="flex rounded-lg shadow-lg overflow-hidden cursor-pointer">
    <img
      class="h-48 w-30 object-cover"
      :src="book.cover_image"
      :alt="book.title"
    />
    <div class="bg-white p-4 flex flex-col justify-between min-w-0">
      <div class="flex-1 min-w-0 flex flex-col justify-between">
        <div class="flex flex-col">
          <h3 class="font-semibold text-gray-900">
            {{ book.title }}
          </h3>
          <span class="mt-1 text-sm text-gray-500" v-sanitize.inline="metaDataLine">
          </span>
          <p class="mt-3 text-base text-gray-500 leading-5 line-clamp-2">
            {{ book.description }}
          </p>
        </div>
        <div class="flex justify-between items-center">
          <ThemesChips :themes="book.themes" class="" />
          <div class="flex flex-wrap gap-2">
            <span v-for="tag in book.tag_names" :key="tag" class="inline-block text-blue-600 text-sm">
              #{{ tag }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </article>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
  book: {
    type: Object,
    required: true,
  },
});

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
