<template>
  <div id="lezen-section" class="row py-10 px-3">
    <div class="max-w-6xl mx-auto">
      <h1 class="text-center">Lezen</h1>
      <div v-if="!isGeladen" class="grid gap-5 mx-auto mt-12 grid-cols-3 sm:grid-cols-5">
        <div
          v-for="i in Array(5).keys()"
          :key="i"
          class="rounded-sm overflow-hidden animate-pulse aspect-213/320 bg-gray-200"
        ></div>
      </div>
      <div v-else-if="heeftBoeken" class="grid gap-5 mx-auto mt-12 grid-cols-3 sm:grid-cols-5">
        <a v-for="book in boeken" :key="book.id" href="/boeken" :title="book.title">
          <BookCover :cover-image="book.cover_image" :title="book.title" class="shadow-md" />
        </a>
      </div>
      <div v-else class="flex justify-center items-center py-8">
        <div class="text-gray-400">
          <h3>{{ __("general.no_results") }}</h3>
        </div>
      </div>
      <div class="flex items-center justify-center mt-12">
        <a href="/boeken">
          <button
            class="primary flex items-center hover:translate-x-[0.250rem]"
            data-umami-event="View all books button on homepage"
          >
            <p class="text-lg">{{ __("books.view_all_books") }}</p>
            <svg
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              class="w-5 h-5 mr-2 ml-1"
              style="transform: rotate(180deg)"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 19l-7-7m0 0l7-7m-7 7h18"
              ></path>
            </svg>
          </button>
        </a>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import debounce from "lodash/debounce";
import axios from "axios";
import BookCover from "../partials/BookCover.vue";
import { useTranslate } from "@composables";
const __ = useTranslate();

const props = defineProps({
  routes: {
    type: Object,
    required: true,
  },
});

const boeken = ref([]);
const isGeladen = ref(false);
const hasError = ref(false);
const heeftBoeken = ref(false);

const getBoeken = debounce(() => {
  isGeladen.value = false;
  hasError.value = false;
  axios
    .get(props.routes["books.search"], {
      params: {
        limit: 5,
      },
    })
    .then((response) => {
      boeken.value = response.data.books;
    })
    .catch((error) => {
      hasError.value = true;
      console.error(error);
    })
    .finally(() => {
      isGeladen.value = true;
      if (boeken.value.length > 0) heeftBoeken.value = true;
    });
}, 300);

onMounted(() => {
  getBoeken();
});
</script>
