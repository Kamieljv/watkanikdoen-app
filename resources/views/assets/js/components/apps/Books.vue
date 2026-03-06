<template>
  <div>
    <div class="row mx-auto max-w-6xl mb-8">
      <div class="col" style="width: 100%">
        <div class="relative mx-auto w-full">
          <div class="relative mx-auto max-w-7xl">
            <div class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3">
              <BookItemList
                v-for="book in books"
                :key="book.id"
                :book="book"
                @click="openBookModal($event, book)"
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

    <!-- Referentie Modal -->
    <Dialog
      v-if="currentBook"
      v-model:visible="modalOpen"
      modal
      class="w-full sm:w-1/2 m-[2px] sm:m-0 overflow-hidden"
      :dismissable-mask="true"
      :draggable="false"
      pt:mask:class="dialog-mask"
      pt:header:class="flex !p-0 items-center justify-between shrink-0 rounded-tl-lg rounded-tr-lg text-surface-700 dark:text-surface-0/80"
      pt:headeractions:class="flex items-center absolute top-0 right-0 m-3"
      pt:content:class="p-5 text-surface-700 dark:text-surface-0/80 overflow-y-auto"
      pt:footer:class="flex items-center justify-end shrink-0 text-right gap-2 px-5 pb-5 border-t-0 rounded-b-lg bg-surface-0 dark:bg-surface-900 text-surface-700 dark:text-surface-0/80"
    >
      <template #header>
        <img
          v-if="currentBook.image_url"
          class="object-cover w-full h-[20rem]"
          :src="currentBook.image_url"
          alt=""
        />
        <ul class="themes-container flex flex-wrap m-3 absolute top-0 w-4/5">
          <li
            v-for="theme in currentBook.themes"
            :key="theme.id"
            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
            :style="{ backgroundColor: theme.color }"
          >
            <span class="text-white" rel="theme">
              {{ theme.name }}
            </span>
          </li>
        </ul>
      </template>
      <div class="title-body-container overflow-hidden relative">
        <h3
          class="line-clamp-2 uppercase text-xl font-semibold leading-7 text-gray-900"
        >
          {{ currentBook.title }}
        </h3>
        <p
          v-sanitize.inline="currentBook.description"
          class="my-2 text-sm text-gray-500"
        ></p>
        <div class="mt-4">
          <p class="text-sm text-gray-500 font-semibold">
            Wat kun je hier doen?
          </p>
          <ul class="flex flex-wrap my-2">
            <li
              v-for="refType in currentBook.referentie_types"
              :key="refType.id"
              class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-700 rounded"
            >
              <a :href="refType.link" class="tag-link cursor-pointer">
                <span class="text-white" rel="theme">
                  {{ refType.title }}
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <template #footer>
        <div class="flex justify-end">
          <a :href="currentBook.url" target="_blank">
            <button class="btn pink items-center" type="button">
              {{ __("general.go_to") }}&nbsp;
              <span>{{ simplifyUrl(currentBook.url) }}</span>
            </button>
          </a>
        </div>
      </template>
    </Dialog>
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
const modalOpen = ref(false);
// const skeletonArray = ref([...Array(props.max ?? 9).keys()]);

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

const openBookModal = (e, book) => {
  currentBook.value = book;
  modalOpen.value = true;
};

const simplifyUrl = (url) => {
  return url.replace(/(^\w+:|^)\/\//, "").replace(/\/$/, "");
};

onMounted(() => {
  getBooks();
});

</script>
<style>
a.tag-link {
  color: inherit;
  text-decoration: none !important;
}

.dialog-mask {
  background-color: rgba(0, 0, 0, 0.5);
}
</style>
