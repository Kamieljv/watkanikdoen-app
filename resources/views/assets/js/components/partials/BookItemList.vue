<template>
  <article class="flex flex-col rounded-lg shadow-lg overflow-hidden">
    <div class="relative">
      <img
        class="h-48 w-full object-cover"
        :src="book.image_url"
        :alt="book.title"
      />
      <ThemesChips :themes="book.themes" class="absolute top-2 left-2" />
    </div>
    <div class="flex-1 bg-white p-4 flex flex-col justify-between">
      <div class="flex-1">
        <p class="text-sm font-medium text-indigo-600">
          {{ book.author }}
        </p>
        <a :href="book.link" target="_blank" class="block mt-2">
          <p class="text-xl font-semibold text-gray-900">
            {{ book.title }}
          </p>
          <p class="mt-3 text-base text-gray-500">
            {{ book.description }}
          </p>
        </a>
      </div>
    </div>
  </article>
</template>

<script setup lang="ts">
const props = defineProps({
  book: {
    type: Object,
    required: true,
  },
});

const book = props.book;
</script>
