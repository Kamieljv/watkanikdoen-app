<template>
  <article class="flex cursor-pointer w-80 h-60 gap-4 md:gap-2">
    <!-- Book Cover (standing on shelf) -->
    <BookCover
      :cover-image="book.cover_image"
      :title="book.title"
      class="drop-shadow-lg drop-shadow-gray-400/30"
    />

    <!-- Book Info (next to book) -->
    <div class="w-full">
      <h3 class="font-bold text-gray-900 text-sm line-clamp-2 mb-1 leading-4">
        {{ book.title }}
      </h3>
      <p class="text-xs text-gray-500 mb-1" v-sanitize.inline="">
        {{ book.author }}<br />
        {{ book.year }}
      </p>
      <p
        v-if="book.notes"
        class="text-sm md:text-xs text-gray-500 leading-4 line-clamp-6 italic mt-2"
      >
        "{{ book.notes.note }}"
      </p>
    </div>
  </article>
</template>

<script setup lang="ts">
import BookCover from "./BookCover.vue";
import { BookShelfBook } from "../../models";

const props = defineProps({
  book: {
    type: Object as () => BookShelfBook,
    required: true,
  },
});
const book = props.book;
</script>
