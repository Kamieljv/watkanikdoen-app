<template>
  <Dialog
    :visible="props.open"
    @update:visible="updateVisible"
    modal
    class="w-full sm:w-2/3 max-w-200 m-0.5 sm:m-0 overflow-hidden"
    :dismissable-mask="true"
    :draggable="false"
    pt:mask:class="dialog-mask"
    pt:header:class="flex !p-0 items-center justify-between shrink-0 text-surface-700 dark:text-surface-0/80"
    pt:headeractions:class="flex items-center absolute top-0 right-0 m-3"
    pt:content:class="!p-10 text-surface-700 dark:text-surface-0/80 overflow-y-auto"
    pt:footer:class="flex items-center justify-end shrink-0 text-right gap-2 px-5 pb-5 border-t-0 bg-surface-0 dark:bg-surface-900 text-surface-700 dark:text-surface-0/80"
  >
    <template #header>
      <div class="w-full h-10"></div>
    </template>
    <div class="flex flex-col gap-8 relative">
      <div
        class="w-full flex gap-3 sm:gap-6 justify-center items-center flex-col sm:flex-row"
      >
        <div class="shrink-0 h-60 w-40 bg-gray-300 relative">
          <div
            v-if="!imageLoaded"
            class="absolute inset-0 flex items-center justify-center bg-gray-200 text-gray-400 drop-shadow-lg drop-shadow-gray-300/50"
          >
            <LogoIcon class="h-12 w-12" style="fill: currentColor" />
          </div>
          <img
            class="w-full h-full object-contain sm:object-cover transition-opacity duration-300 drop-shadow-lg drop-shadow-gray-300/50"
            :class="imageLoaded ? 'opacity-100' : 'opacity-0'"
            :src="props.book.cover_image"
            :alt="props.book.title"
            @load="imageLoaded = true"
            @error="imageError = true"
          />
        </div>
        <div>
          <h3
            class="line-clamp-2 uppercase text-xl font-semibold leading-7 text-gray-900 text-center"
          >
            {{ props.book.title }}
          </h3>
          <p class="text-sm text-gray-500 text-center">
            {{ props.book.author }}
          </p>
          <div class="flex justify-center">
            <ThemesChips
              :themes="props.book.themes"
              class="justify-center my-3"
            />
          </div>
          <div class="flex flex-wrap gap-2 justify-center">
            <span
              v-for="tag in props.book.tag_names"
              :key="tag"
              class="inline-block text-blue-600 text-sm"
            >
              #{{ tag }}
            </span>
          </div>
        </div>
      </div>
      <div class="flex flex-col items-center overflow-visible">
        <div class="relative">
          <p
            v-sanitize.inline="props.book.description"
            class="text-sm text-gray-700 transition-all duration-300"
            :class="
              descriptionExpanded ? 'max-h-1000' : 'max-h-24 overflow-hidden'
            "
          ></p>
          <div
            v-if="!descriptionExpanded"
            class="absolute flex justify-center left-0 right-0 bottom-0 bg-linear-to-t from-white to-transparent h-15"
          ></div>
        </div>
        <button
          v-if="!descriptionExpanded"
          class="absolute -bottom-4 text-sm bg-white py-1 px-2 -mt-2 z-20 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200"
          type="button"
          @click="descriptionExpanded = !descriptionExpanded"
        >
          {{ __("general.read_more") }}
        </button>
      </div>
    </div>
    <template #footer>
      <div class="flex justify-end">
        <a :href="getSearchUrl(props.book.title)" target="_blank">
          <button class="btn pink flex gap-2 items-center" type="button">
            {{ __("books.search_online") }}
            <NewTabIcon class="w-4 h-4" />
          </button>
        </a>
      </div>
    </template>
  </Dialog>
</template>

<script setup lang="ts">
import { ref, inject } from "vue";
import NewTabIcon from "&/lucide-external-link.svg";
import LogoIcon from "&/logo-icon.svg";
import ThemesChips from "./ThemesChips.vue";
import { useTranslate } from "@composables";
const __ = useTranslate();

const emit = defineEmits(["update:visible"]);

const props = defineProps({
  book: {
    type: Object,
    required: true,
  },
  open: {
    type: Boolean,
    default: false,
  },
});

const descriptionExpanded = ref(false);
const imageLoaded = ref(false);
const imageError = ref(false);

const updateVisible = (value: boolean) => {
  emit("update:visible", value);
  if (!value) descriptionExpanded.value = false;
};

const getSearchUrl = (title: string) => {
  const query = encodeURIComponent(title);
  return `https://www.ecosia.org/search?q=${query}`;
};
</script>

<style>
.dialog-mask {
  background-color: rgba(0, 0, 0, 0.5);
}
</style>
