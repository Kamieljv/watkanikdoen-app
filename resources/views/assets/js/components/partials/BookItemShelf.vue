<template>
  <article class="flex cursor-pointer w-100 h-60 gap-4 md:gap-2">
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
      <div
        v-if="book.notes"
        class="flex flex-col text-sm md:text-xs text-gray-300 leading-4 italic m-2"
      >
        <QuoteIcon class="w-8 h-8" fill="currentColor" />
        <div class="pl-2 text-gray-500 line-clamp-6">{{ book.notes.note }}</div>
        <QuoteIcon class="ml-auto w-6 h-6 rotate-180" fill="currentColor" />
      </div>
    </div>
  </article>
</template>

<script setup lang="ts">
import BookCover from "./BookCover.vue";
import QuoteIcon from "&/iconpark-iconpark-quote.svg";
import { BookShelfBook } from "../../models";

const props = defineProps({
  book: {
    type: Object as () => BookShelfBook,
    required: true,
  },
});
const book = props.book;
</script>
