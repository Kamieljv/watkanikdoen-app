<template>
  <div class="row mx-auto max-w-6xl">
    <BookShelfSmall v-for="shelf in shelves" :key="shelf.id" :shelf="shelf" />
  </div>
</template>

<script setup lang="ts">
import { useTranslate } from "@composables";
import { type BookShelf } from "../../models";

const __ = useTranslate();

const props = defineProps({
  shelves: {
    type: Array as () => BookShelf[],
    required: true,
  },
});
</script>
