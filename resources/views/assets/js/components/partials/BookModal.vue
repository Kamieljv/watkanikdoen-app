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
    pt:footer:class="flex items-center justify-end shrink-0 text-right gap-2 px-5 py-5! border-t-0 bg-surface-0 dark:bg-surface-900 text-surface-700 dark:text-surface-0/80"
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
          class="shrink-0 h-60 w-40 drop-shadow-lg drop-shadow-gray-300/50"
        />
        <div>
          <h3 class="text-xl font-semibold leading-7 text-gray-900 text-center">
            {{ props.book.title }}
          </h3>
          <p class="text-sm text-gray-400 text-center">
            {{ props.book.author }} | {{ props.book.year }}
          </p>
          <div class="flex justify-center">
            <ThemesChips
              :themes="props.book.themes"
              class="justify-center my-3"
            />
          </div>
          <div class="flex flex-wrap gap-2 justify-center">
            <TagChip
              v-for="tag in props.book.tag_names"
              :key="tag"
              :tag="tag"
            />
          </div>
        </div>
      </div>
      <div
        v-if="props.book.description"
        class="flex flex-col items-center mb-3 overflow-visible relative"
      >
        <div class="w-full">
          <h5 class="mb-1">Omschrijving</h5>
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
          class="absolute -bottom-8 rounded-lg text-sm text-white bg-gray-500 shadow-sm py-1.5 px-3 -mt-2 z-20 cursor-pointer hover:bg-gray-700 transition-colors duration-200"
          type="button"
          @click="descriptionExpanded = !descriptionExpanded"
        >
          {{ __("general.read_more") }}
        </button>
      </div>
      <div
        v-if="hasNotes"
        class="flex flex-col gap-2 p-3 rounded-md mt-5 bg-gray-100"
      >
        <h4 class="flex items-center gap-2 text-md font-semibold text-gray-900">
          <span class="text-gray-500">{{ __("books.recommended_by") }}</span>
          <OrganizerChip
            :organizer="(props.book as BookShelfBook).notes.organizer"
          />
        </h4>
        <p class="text-sm italic text-gray-700 whitespace-pre-wrap">
          "{{ (props.book as BookShelfBook).notes.note }}"
        </p>
      </div>
      <div v-if="showBookShelfLink" class="flex flex-col gap-2 mt-5">
        <a
          v-for="shelf in props.book.book_shelves"
          :key="shelf.slug"
          :href="`/boekenplank/${shelf.slug}`"
          class="flex items-center justify-between p-2 pl-4 bg-gray-100 rounded-md gap-2 text-sm text-gray-600"
        >
          <div class="flex items-center gap-1">
            {{ __("books.view_on_shelf_of") }}
            <b
              ><OrganizerChip :organizer="shelf.organizer" :clickable="false"
            /></b>
          </div>
          <button class="gray hidden md:flex items-center gap-1">
            {{ __("general.view") }}
            <ArrowRightIcon class="w-5 h-5 rotate-90 inline-block" />
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
import { computed, ref } from "vue";
import NewTabIcon from "&/lucide-external-link.svg";
import ArrowRightIcon from "&/clarity-arrow-line.svg";
import ThemesChips from "./ThemesChips.vue";
import TagChip from "./TagChip.vue";
import { Book, type BookShelfBook } from "../../models";
import { useTranslate } from "@composables";
const __ = useTranslate();

const emit = defineEmits(["update:visible"]);

const props = defineProps({
  book: {
    type: Object as () => Book | BookShelfBook,
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
const hasNotes = computed(() => props.book && "notes" in props.book);

const updateVisible = (value: boolean) => {
  emit("update:visible", value);
  if (!value) descriptionExpanded.value = false;
};

const getSearchUrl = (title: string) => {
  const query = encodeURIComponent(title);
  return `https://www.ecosia.org/search?q=${query} boek`;
};
</script>

<style>
.dialog-mask {
  background-color: rgba(0, 0, 0, 0.5);
}
</style>
