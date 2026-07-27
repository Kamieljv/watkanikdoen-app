<template>
  <article
    class="flex flex-col sm:flex-row rounded-lg shadow-lg overflow-hidden cursor-pointer"
  >
    <BookCover
      :cover-image="book.cover_image"
      :title="book.title"
      object-fit="object-contain"
      class="shrink-0 h-48 w-full sm:w-30 py-2 sm:p-0 bg-gray-300"
    />
    <div class="bg-white p-4 flex flex-1 flex-col justify-between min-w-0">
      <div class="flex-1 min-w-0 flex flex-col justify-between">
        <div class="flex flex-col">
          <h3 class="text-xl font-bold text-gray-900">
            {{ book.title }}
          </h3>
          <span
            class="mt-1 text-sm text-gray-400"
            v-sanitize.inline="metaDataLine"
          >
          </span>
          <p class="mt-3 text-sm text-gray-500 leading-5 line-clamp-2">
            {{ book.description }}
          </p>
        </div>
        <div class="flex gap-2 justify-between items-center flex-wrap mt-4">
          <ThemesChips :themes="book.themes" :max-visible="isMobile ? 3 : 6" />
          <div class="flex flex-wrap gap-2 mb-1">
            <TagChip v-for="tag in book.tag_names" :key="tag" :tag="tag" />
          </div>
        </div>
      </div>
    </div>
  </article>
</template>

<script setup lang="ts">
import { computed } from "vue";
import BookCover from "./BookCover.vue";
import ThemesChips from "./ThemesChips.vue";
import { Book } from "../../models";
import { useWindowSize } from "@composables";
import TagChip from "./TagChip.vue";

const props = defineProps({
  book: {
    type: Object as () => Book,
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

const isMobile = computed(() => useWindowSize().width.value < 640);
</script>
