<template>
  <a :href="`/boekenplank/${shelf.slug}`">
    <div class="bg-white rounded-lg shadow-md">
      <div class="p-4 flex flex-col gap-2">
        <div class="flex justify-between items-center">
          <h1 class="text-xl font-bold text-gray-900">
            <span class="font-medium text-gray-600">{{
              __("books.shelf_of")
            }}</span>
            {{ shelf.organizer.name }}
          </h1>
        </div>
        <ThemesChips :themes="shelf.themes" />
        <p class="text-sm text-gray-700 line-clamp-2">
          {{ shelf.description }}
        </p>
      </div>
      <div class="bg-gray-200">
        <div
          class="flex gap-4 p-4 overflow-x-scroll overflow-y-visible [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
        >
          <BookCover
            v-for="book in shelf.books"
            :key="book.id"
            :cover-image="book.cover_image"
            :title="book.title"
            class="h-40 aspect-2/3 drop-shadow-lg drop-shadow-gray-400/60"
          />
        </div>
      </div>
    </div>
  </a>
</template>

<script setup lang="ts">
import BookCover from "./BookCover.vue";
import ThemesChips from "./ThemesChips.vue";
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
