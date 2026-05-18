<template>
  <div class="bg-white rounded-lg shadow-md mb-8 p-6">
    <h1 class="text-2xl font-bold text-gray-900">
      {{ shelf.title }}
    </h1>
    <div class="mt-2">
      <ThemesChips :themes="shelf.themes" class="mb-4" />
      <div class="flex gap-4 overflow-x-scroll">
        <BookCover
          v-for="book in shelf.books"
          :key="book.id"
          :cover-image="book.cover_image"
          :title="book.title"
          class="h-40 aspect-2/3 drop-shadow-lg drop-shadow-gray-400/30"
        />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import BookCover from "./BookCover.vue";
import { type BookShelf } from "../../models";
import { useTranslate } from "@composables";

const __ = useTranslate();

const props = defineProps({
  shelf: {
    type: Object as () => BookShelf,
    required: true,
  },
});
</script>
