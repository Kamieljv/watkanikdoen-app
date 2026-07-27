<template>
  <a :href="`/boekenplank/${shelf.slug}`">
    <div class="bg-white rounded-lg shadow-md">
      <div class="p-4 flex flex-col gap-1">
        <div class="flex justify-between items-center">
          <h1 class="flex items-center gap-1 text-xl font-bold text-gray-900">
            <span class="text-gray-500">{{ __("books.shelf_of") }}</span>
            <OrganizerChip :organizer="shelf.organizer" :clickable="false" />
          </h1>
        </div>
        <div class="flex gap-2 justify-between items-center flex-wrap mt-4">
          <ThemesChips :themes="shelf.themes" :max-visible="isMobile ? 3 : 6" />
          <div class="flex flex-wrap gap-2 mb-1">
            <TagChip v-for="tag in shelf.tag_names" :key="tag" :tag="tag" />
          </div>
        </div>
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
import { useTranslate, useWindowSize } from "@composables";
import { computed } from "vue";

const __ = useTranslate();

const props = defineProps({
  shelf: {
    type: Object as () => BookShelf,
    required: true,
  },
});

const isMobile = computed(() => useWindowSize().width.value < 640);
</script>
