<template>
  <div>
    <div class="row mx-auto max-w-6xl mb-8">
      <div class="col">
        <h1 class="text-3xl font-bold text-gray-900">
          {{ shelf.title }}
        </h1>
      </div>
      <div class="col" style="width: 100%">
        <div class="relative mx-auto w-full">
          <div class="relative mx-auto max-w-6xl">
            <!-- Bookshelf with repeating shelves -->
            <div class="mt-12" :class="{ shelf: !isMobile }">
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
import { computed, ref } from "vue";

const __ = useTranslate();

const props = defineProps({
  shelf: {
    type: Object as () => BookShelf,
    required: true,
  },
});

const currentBook = ref<BookShelfBook | null>(null);
const { width } = useWindowSize();
const isMobile = computed(() => width.value < 768);
</script>

<style lang="css" scoped>
.shelf {
  background-image: repeating-linear-gradient(
    to bottom,
    transparent 0,
    transparent calc(100% - 8px),
    #d1d5db calc(100% - 8px),
    #d1d5db 100%
  );
  background-size: 100% 290px;
  background-position: 0 -35px;
}
</style>
