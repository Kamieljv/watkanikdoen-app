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
              <BookItemList
                v-for="book in books"
                :key="book.id"
                :book="book"
                @click="currentBook = book"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- see more button -->
    <div
      v-if="
        enableShowMore &&
        hasBooks &&
        total &&
        perPage &&
        total > perPage &&
        currentPage !== lastPage &&
        !appending
      "
      class="flex justify-center"
    >
      <button class="btn secondary" @click="loadMore">
        {{ __("general.load_more") }}
      </button>
    </div>
    <div v-else-if="appending" class="flex justify-center">
      <div class="custom-loader dark large"></div>
    </div>

    <BookModal
      v-if="currentBook"
      :book="currentBook"
      :open="currentBook !== null"
      @update:visible="currentBook = null"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, inject, watch, Ref } from "vue";
import axios from "axios";
import debounce from "lodash/debounce";
import BookItemList from "../partials/BookItemList.vue";
import BookModal from "../partials/BookModal.vue";
import { Book } from "../../models";

const __: (key: string) => string = inject("translate", (key: string) => key);

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
});

const books = ref<Book[]>([]);
const currentBook = ref<Book | null>(null);
const isLoading = ref(true);
const hasError = ref(false);
const currentPage = ref(1);
const lastPage = ref<number | null>(null);
const perPage = ref<number | null>(null);
const total = ref<number | null>(null);
const appending = ref(false);

const hasBooks = computed(() => books.value.length > 0);

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

const loadMore = () => {
  currentPage.value++;
  appending.value = true;
  getBooks();
};

onMounted(() => {
  getBooks();
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
