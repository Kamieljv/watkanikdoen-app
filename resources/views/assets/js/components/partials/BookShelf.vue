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
        <p class="text-sm text-gray-700">{{ shelf.description }}</p>
        <div class="flex gap-2 justify-between items-center flex-wrap mt-4">
          <ThemesChips :themes="shelf.themes" :max-visible="6" />
          <div class="flex flex-wrap gap-2 mb-1">
            <TagChip v-for="tag in shelf.tag_names" :key="tag" :tag="tag" />
          </div>
        </div>
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
                class="flex flex-wrap leading-0 gap-x-10 gap-y-12.5 align-start justify-center pb-10"
              >
                <BookItemShelf
                  v-for="book in shelf.books"
                  :key="book.id"
                  :book="book"
                  @click="openBook(book)"
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
      @update:visible="closeBook"
    />
  </div>
</template>

<script setup lang="ts">
import BookItemShelf from "../partials/BookItemShelf.vue";
import BookModal from "../partials/BookModal.vue";
import { BookShelf, BookShelfBook } from "../../models";
import { useTranslate, useWindowSize } from "@composables";
import { onBeforeUnmount, onMounted, ref } from "vue";
/* @ts-ignore */
import shelfLine from "&/bookshelf.svg?url";

const __ = useTranslate();

const props = defineProps({
  shelf: {
    type: Object as () => BookShelf,
    required: true,
  },
});

// The open book is reflected in the URL as ?boek=ID (same as BookList.vue),
// so a book can be linked to directly, e.g. from BookShelfSmall
const BOOK_PARAM = "boek";

const bookFromUrl = () => {
  const id = Number(new URL(window.location.href).searchParams.get(BOOK_PARAM));
  return (id && props.shelf.books.find((book) => book.id === id)) || null;
};

const urlWithBook = (id: number | null) => {
  const url = new URL(window.location.href);
  if (id) url.searchParams.set(BOOK_PARAM, String(id));
  else url.searchParams.delete(BOOK_PARAM);
  return url;
};

const currentBook = ref<BookShelfBook | null>(bookFromUrl());

const openBook = (book: BookShelfBook) => {
  currentBook.value = book;
  // New history entry, so the back button closes the modal
  window.history.pushState({ bookId: book.id }, "", urlWithBook(book.id));
};

const closeBook = () => {
  if (window.history.state?.bookId) {
    // Opened on this page: go back to the entry without ?boek (onPopState closes the modal)
    window.history.back();
    return;
  }
  // Opened via a link (?boek=ID on load): drop the parameter, so a refresh doesn't reopen it
  currentBook.value = null;
  window.history.replaceState(window.history.state, "", urlWithBook(null));
};

// Back/forward: show the book from the URL, if any
const onPopState = () => {
  currentBook.value = bookFromUrl();
};

onMounted(() => window.addEventListener("popstate", onPopState));
onBeforeUnmount(() => window.removeEventListener("popstate", onPopState));
</script>

<style lang="css" scoped>
.shelf {
  background-size: 100% 290px;
  background-repeat: repeat-y;
  background-position: 0 -28px;
}
</style>
