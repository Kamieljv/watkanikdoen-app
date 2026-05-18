<template>
  <article class="flex cursor-pointer w-90 h-60 gap-4 md:gap-2">
    <!-- Book Cover (standing on shelf) -->
    <BookCover
      :cover-image="book.cover_image"
      :title="book.title"
      class="w-full aspect-2/3 drop-shadow-lg drop-shadow-gray-400/30"
    />

    <!-- Book Info (below shelf) -->
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
        class="text-sm md:text-xs text-gray-600 leading-4 line-clamp-10 italic mt-2"
      >
        "{{ book.notes }} {{ book.notes }} {{ book.notes }} {{ book.notes }}"
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
