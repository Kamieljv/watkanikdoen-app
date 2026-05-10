<template>
  <div>
    <div class="row mx-auto max-w-6xl mb-8">
      <div class="flex flex-col items-center mt-10">
        <h2 class="text-xl text-gray-700">
          {{ __("books.filter_by_themes") }}
        </h2>
        <ThemeSelector
          v-model="themesSelected"
          :themes="props.themes"
          class="my-5 w-full sm:w-2/3"
        />
      </div>
      <hr class="my-8 border-gray-200" />
    </div>

    <BookList
      :search-route="props.routes['books.search']"
      :selected-theme-ids="themesSelected"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, inject } from "vue";
import { Theme } from "../../models";
import ThemeSelector from "../partials/ThemeSelector.vue";
import BookList from "../partials/BookList.vue";

import { useTranslate } from "@composables";
const __ = useTranslate();

const props = defineProps({
  routes: {
    type: Object,
    default: () => {},
  },
  themes: {
    type: Array<Theme>,
    default: () => [],
  },
});

const themesSelected = ref([]);
</script>

<style>
a.tag-link {
  color: inherit;
  text-decoration: none !important;
}
</style>
