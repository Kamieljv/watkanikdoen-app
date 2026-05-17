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
          <div class="relative mx-auto max-w-7xl">
            <!-- The Bookshelf -->
            <div class="relative mt-12">
              <!-- Books on shelf -->
              <div class="flex flex-wrap gap-6 justify-center pb-3">
                <BookItemShelf
                  v-for="book in shelf.books"
                  :key="book.id"
                  :book="book"
                  @click="currentBook = book"
                />
              </div>

              <!-- The Shelf (thick gray line) -->
              <div
                class="absolute bottom-0 left-0 right-0 h-2 bg-gray-300"
                style="border-radius: 2px"
              ></div>
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
import { useTranslate } from "@composables";
import { onMounted, ref } from "vue";

const __ = useTranslate();

const props = defineProps({
  shelf: {
    type: Object as () => BookShelf,
    required: true,
  },
});

onMounted(() => {
  console.log(props.shelf.books);
});

const currentBook = ref<BookShelfBook | null>(null);
</script>
