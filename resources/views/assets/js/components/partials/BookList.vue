<template>
  <div>
    <div class="row mx-auto max-w-6xl mb-8">
      <div class="col" style="width: 100%">
        <div class="relative mx-auto w-full">
          <div class="relative mx-auto max-w-7xl">
            <div
              v-if="isLoading && !appending"
              class="flex justify-center py-12"
            >
              <div class="custom-loader dark large"></div>
            </div>
            <div v-else-if="hasError" class="text-center py-12 text-red-600">
              {{ __("general.error_loading") }}
            </div>
            <div
              v-else-if="!hasBooks && !isLoading"
              class="text-center py-12 text-gray-500"
            >
              {{ __("books.no_books_found") }}
            </div>
            <div v-else class="flex flex-col gap-5 mx-auto mt-12">
              <template
                v-for="item in interleavedItems"
                :key="item.type + '-' + item.id"
              >
                <BookItemList
                  v-if="item.type === 'book'"
                  :book="item.data"
                  @click="openBook(item.data)"
                />
                <BookShelfSmall
                  v-else-if="item.type === 'shelf'"
                  :shelf="item.data"
                />
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Sentinel: loads the next page automatically when scrolled into view -->
    <div v-if="canLoadMore" ref="loadMoreTrigger" aria-hidden="true"></div>
    <div v-else-if="appending" class="flex justify-center">
      <div class="custom-loader dark large"></div>
    </div>

    <BookModal
      v-if="currentBook"
      :book="currentBook"
      :open="currentBook !== null"
      @update:visible="closeBook"
    />
  </div>
</template>

<script setup lang="ts">
import {
  ref,
  computed,
  onMounted,
  onUnmounted,
  watch,
  useTemplateRef,
  type PropType,
} from "vue";
import axios from "axios";
import debounce from "lodash/debounce";
import BookItemList from "../partials/BookItemList.vue";
import BookShelfSmall from "../partials/BookShelfSmall.vue";
import BookModal from "../partials/BookModal.vue";
import { Book, BookShelf } from "../../models";
import { useTranslate } from "@composables";

const __ = useTranslate();

const props = defineProps({
  searchRoute: {
    type: String,
    required: true,
  },
  selectedThemeIds: {
    type: Array as () => number[],
    default: () => [],
  },
  enableShowMore: {
    type: Boolean,
    default: true,
  },
  max: {
    type: Number,
    default: null,
  },
  bookshelves: {
    type: Array as () => BookShelf[],
    default: () => [],
  },
  // Book whose modal is opened on load
  initialBook: {
    type: Object as PropType<Book | null>,
    default: null,
  },
});

const books = ref<Book[]>([]);
const currentBook = ref<Book | null>(props.initialBook);
const isLoading = ref(true);
const hasError = ref(false);
const currentPage = ref(1);
const lastPage = ref<number | null>(null);
const perPage = ref<number | null>(null);
const total = ref<number | null>(null);
const appending = ref(false);

const hasBooks = computed(() => books.value.length > 0);
const canLoadMore = computed(
  () =>
    props.enableShowMore &&
    hasBooks.value &&
    !hasError.value &&
    !isLoading.value &&
    !appending.value &&
    lastPage.value !== null &&
    currentPage.value < lastPage.value,
);
const loadMoreTrigger = useTemplateRef<HTMLElement>("loadMoreTrigger");
const filteredShelves = computed(() => {
  if (props.selectedThemeIds.length === 0) return props.bookshelves;
  return props.bookshelves.filter((shelf) =>
    shelf.themes.some((theme) => props.selectedThemeIds.includes(theme.id)),
  );
});

const interleavedItems = computed(() => {
  const items: Array<
    | { type: "book"; data: Book; id: number }
    | { type: "shelf"; data: BookShelf; id: number }
  > = [];
  let shelfIndex = 0;

  books.value.forEach((book, index) => {
    // Add the book
    items.push({ type: "book", data: book, id: book.id });

    // After every 5 books, add a bookshelf if available
    if ((index + 1) % 5 === 0 && shelfIndex < filteredShelves.value.length) {
      items.push({
        type: "shelf",
        data: filteredShelves.value[shelfIndex],
        id: filteredShelves.value[shelfIndex].id,
      });
      shelfIndex++;
    }
  });

  return items;
});

const getBooks = debounce(() => {
  isLoading.value = true;
  hasError.value = false;

  axios
    .get(props.searchRoute, {
      params: {
        themes: props.selectedThemeIds,
        page: currentPage.value,
        limit: props.max,
      },
    })
    .then((response) => {
      if ("per_page" in response.data.books) {
        if (appending.value) {
          books.value = books.value.concat(response.data.books.data);
        } else {
          books.value = response.data.books.data;
        }
        currentPage.value = response.data.books.current_page;
        lastPage.value = response.data.books.last_page;
        perPage.value = response.data.books.per_page;
        total.value = response.data.books.total;
      } else {
        books.value = response.data.books;
      }
    })
    .catch(() => {
      hasError.value = true;
    })
    .finally(() => {
      isLoading.value = false;
      appending.value = false;
    });
}, 500);

// The open book is reflected in the URL as ?boek=ID, so it can be shared as a link
const BOOK_PARAM = "boek";

const urlWithBook = (id: number | null) => {
  const url = new URL(window.location.href);
  if (id) url.searchParams.set(BOOK_PARAM, String(id));
  else url.searchParams.delete(BOOK_PARAM);
  return url;
};

const openBook = (book: Book) => {
  currentBook.value = book;
  // New history entry, so the back button closes the modal
  window.history.pushState({ bookId: book.id }, "", urlWithBook(book.id));
};

const closeBook = () => {
  if (window.history.state?.bookId) {
    // Opened from the list: go back to the entry without ?boek (onPopState closes the modal)
    window.history.back();
    return;
  }
  // Opened via a link (?boek=ID on load): drop the parameter, so a refresh doesn't reopen it
  currentBook.value = null;
  window.history.replaceState(window.history.state, "", urlWithBook(null));
};

// Back/forward: show the book from the URL, if any
const onPopState = () => {
  const id = Number(new URL(window.location.href).searchParams.get(BOOK_PARAM));
  currentBook.value =
    (id &&
      [props.initialBook, ...books.value].find((book) => book?.id === id)) ||
    null;
};

const loadMore = () => {
  if (!canLoadMore.value) return;
  currentPage.value++;
  appending.value = true;
  getBooks();
};

// Start loading a bit before the bottom of the list is actually reached
const loadMoreObserver = new IntersectionObserver(
  (entries) => {
    if (entries.some((entry) => entry.isIntersecting)) loadMore();
  },
  { rootMargin: "0px 0px 400px 0px" },
);

// The sentinel is re-rendered after each page load, so (re)observe it whenever it
// appears; if it's still in view after loading, this immediately triggers the next page
watch(loadMoreTrigger, (el, oldEl) => {
  if (oldEl) loadMoreObserver.unobserve(oldEl);
  if (el) loadMoreObserver.observe(el);
});

onMounted(() => {
  window.addEventListener("popstate", onPopState);
  getBooks();
});

onUnmounted(() => {
  window.removeEventListener("popstate", onPopState);
  loadMoreObserver.disconnect();
});

// Watch for changes in selected themes and fetch books accordingly
watch(
  () => props.selectedThemeIds,
  () => {
    currentPage.value = 1; // Reset to first page when themes change
    appending.value = false;
    getBooks();
  },
  { deep: true },
);
</script>
