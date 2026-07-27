<template>
  <div>
    <div class="row mx-auto max-w-6xl mb-8">
      <div class="flex flex-col gap-2">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">
          <span class="font-medium text-gray-600">{{
            __("books.shelf_of")
          }}</span>
          {{ shelf.organizer.name }}
        </h1>
        <ThemesChips :themes="shelf.themes" :max-visible="10" />
        <p class="text-sm text-gray-700 mt-2">{{ shelf.description }}</p>
      </div>
      <div class="col" style="width: 100%">
        <div class="relative mx-auto w-full">
          <div class="relative mx-auto max-w-6xl">
            <!-- Bookshelf with repeating shelves -->
            <div
              class="mt-12 shelf"
              :style="{ backgroundImage: `url(${shelfLine})` }"
            >
              <!-- Books on shelves -->
              <div
                class="flex flex-wrap leading-0 gap-x-6 gap-y-12.5 align-start justify-center pb-10"
              >
                <BookItemShelf
                  v-for="book in shelf.books"
                  :key="book.id"
                  :book="book"
                  @click="currentBook = book"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <BookModal
      v-if="currentBook"
      :book="currentBook"
      :open="currentBook !== null"
      :show-book-shelf-link="false"
      @update:visible="currentBook = null"
    />
  </div>
</template>

<script setup lang="ts">
import BookItemShelf from "../partials/BookItemShelf.vue";
import BookModal from "../partials/BookModal.vue";
import { BookShelf, BookShelfBook } from "../../models";
import { useTranslate, useWindowSize } from "@composables";
import { ref } from "vue";
/* @ts-ignore */
import shelfLine from "&/bookshelf.svg?url";

const __ = useTranslate();

const props = defineProps({
  shelf: {
    type: Object as () => BookShelf,
    required: true,
  },
});

const currentBook = ref<BookShelfBook | null>(null);
</script>

<style lang="css" scoped>
.shelf {
  background-size: 100% 290px;
  background-repeat: repeat-y;
  background-position: 0 -28px;
}
</style>
