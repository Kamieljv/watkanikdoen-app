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
        <BookCover
          :cover-image="props.book.cover_image"
          :title="props.book.title"
          object-fit="object-contain"
          class="shrink-0 h-60 w-40 drop-shadow-lg drop-shadow-gray-300/50"
        />
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
      <div class="flex flex-col items-center overflow-visible relative">
        <div class="">
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
      <div v-if="showBookShelfLink" class="flex flex-col gap-2 mt-5">
        <a
          v-for="shelf in props.book.book_shelves"
          :key="shelf.slug"
          :href="`/boekenplank/${shelf.slug}`"
          class="flex items-center justify-between p-2 bg-gray-50 rounded-md border-gray-300 border gap-2 text-sm text-gray-600"
        >
          <div class="flex items-center gap-2">
            <img
              :src="shelf.organizer.image_url"
              :alt="shelf.organizer.name"
              class="w-10 h-10 rounded-full object-cover"
            />
            <span>
              {{ __("books.view_on_shelf_of") }}
              <b>{{ shelf.organizer.name }}</b>
            </span>
          </div>
          <button class="gray hidden md:flex items-center gap-1">
            Bekijk <ArrowRightIcon class="w-5 h-5 rotate-90 inline-block" />
          </button>
        </a>
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
import { ref } from "vue";
import NewTabIcon from "&/lucide-external-link.svg";
import LogoIcon from "&/logo-icon.svg";
import ArrowRightIcon from "&/clarity-arrow-line.svg";
import ThemesChips from "./ThemesChips.vue";
import { Book } from "../../models";
import { useTranslate } from "@composables";
const __ = useTranslate();

const emit = defineEmits(["update:visible"]);

const props = defineProps({
  book: {
    type: Object as () => Book,
    required: true,
  },
  open: {
    type: Boolean,
    default: false,
  },
  showBookShelfLink: {
    type: Boolean,
    default: true,
  },
});

const descriptionExpanded = ref(false);

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
