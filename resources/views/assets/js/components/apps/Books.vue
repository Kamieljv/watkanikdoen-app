<template>
  <div>
    <div class="row mx-auto max-w-6xl mb-8">
      <div class="col" style="width: 100%">
        <div class="relative mx-auto w-full">
          <div class="relative mx-auto max-w-7xl">
            <div class="flex flex-col gap-5 mx-auto mt-12">
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
        total > perPage &&
        currentPage !== lastPage &&
        !appending
      "
      class="flex justify-center"
    >
      <button
        class="btn secondary"
        @click="
          currentPage++;
          appending = true;
          getBooks();
        "
      >
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
import { ref, computed, onMounted, inject } from "vue";
import axios from "axios";
import debounce from "lodash/debounce";
import { Theme } from "../../models";
const __: (key: string) => string = inject("translate");

const props = defineProps({
  routes: {
    type: Object,
    default: () => {},
  },
  themes: {
    type: Array<Theme>,
    default: () => [],
  },
  themesSelectedIds: {
    type: Array<number>,
    default: () => [],
  },
  enableShowMore: {
    type: Boolean,
    default: true,
  },
  max: {
    type: Number,
    default: 10,
  },
});

const books = ref([]);
const currentBook = ref(null);
const themesSelected = ref(
  props.themes
    .filter((t) => props.themesSelectedIds.includes(t.id))
    .map((t) => t.id),
);
const isGeladen = ref(false);
const hasError = ref(false);
const currentPage = ref(null);
const lastPage = ref(null);
const perPage = ref(null);
const total = ref(null);
const appending = ref(false);

const hasBooks = computed(() => books.value.length > 0);

const getBooks = debounce(() => {
  isGeladen.value = false;
  hasError.value = false;
  axios
    .get(props.routes["books.search"], {
      params: {
        themes: themesSelected.value,
        page: currentPage.value,
        limit: props.max ?? null,
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
      isGeladen.value = true;
      appending.value = false;
    });
}, 500);

onMounted(() => {
  getBooks();
});
</script>
<style>
a.tag-link {
  color: inherit;
  text-decoration: none !important;
}
</style>
