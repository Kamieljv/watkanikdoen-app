<template>
  <div class="my-10 md:mx-10">
    <div class="p-4 flex flex-col gap-1">
      <div class="flex justify-between items-center">
        <h1 class="flex items-center gap-1 text-xl font-bold text-gray-900">
          <span class="text-gray-500">{{ __("books.shelf_of") }}</span>
          <OrganizerChip :organizer="shelf.organizer" :clickable="false" />
        </h1>
      </div>
      <div class="flex gap-2 justify-between items-center flex-wrap mt-4">
        <ThemesChips :themes="shelf.themes" :max-visible="isMobile ? 3 : 6" />
        <div class="flex flex-wrap gap-2 mb-1">
          <TagChip v-for="tag in shelf.tag_names" :key="tag" :tag="tag" />
        </div>
      </div>
    </div>
    <div class="px-4 pt-6">
      <!-- Bookshelf with repeating shelves (scaled-down version of BookShelf) -->
      <div class="shelf" :style="{ backgroundImage: `url(${shelfLine})` }">
        <div
          class="flex flex-wrap leading-0 gap-x-6 gap-y-8.5 justify-center pb-6"
        >
          <a
            v-for="book in visibleBooks.slice(0, -1)"
            :key="book.id"
            :href="bookUrl(book)"
          >
            <BookCover
              :cover-image="book.cover_image"
              :title="book.title"
              class="h-40 aspect-2/3 drop-shadow-lg drop-shadow-gray-400/30"
            />
          </a>
          <!-- Last book + button form one unit, so the button never wraps onto a shelf alone -->
          <div class="flex gap-x-6">
            <a v-if="lastBook" :key="lastBook.id" :href="bookUrl(lastBook)">
              <BookCover
                :cover-image="lastBook.cover_image"
                :title="lastBook.title"
                class="h-40 aspect-2/3 drop-shadow-lg drop-shadow-gray-400/30"
              />
            </a>
            <!-- Same height as a cover, so the button sits on the shelf like a book -->
            <div class="h-40 flex items-center">
              <a
                :href="`/boekenplank/${shelf.slug}`"
                class="flex items-center leading-normal text-sm transition-transform duration-150 hover:translate-x-2"
              >
                <div class="flex flex-col items-center">
                  <span>{{ __("books.all_tips_of") }}</span>
                  <span>{{ shelf.organizer.name }}</span>
                </div>
                <ArrowRightIcon class="w-4 h-4 ml-2" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import BookCover from "./BookCover.vue";
import ThemesChips from "./ThemesChips.vue";
import { type BookShelf } from "../../models";
import { useTranslate, useWindowSize } from "@composables";
import { computed } from "vue";
/* @ts-ignore */
import shelfLine from "&/bookshelf.svg?url";
import ArrowRightIcon from "&/arrow-right.svg";

const __ = useTranslate();

const props = defineProps({
  shelf: {
    type: Object as () => BookShelf,
    required: true,
  },
});

const MAX_BOOKS = 5;
const visibleBooks = computed(() => props.shelf.books.slice(0, MAX_BOOKS));
const lastBook = computed(() => visibleBooks.value.at(-1));

// Opens the shelf page with this book's modal open (read by BookShelf.vue)
const bookUrl = (book: { id: number }) =>
  `/boekenplank/${props.shelf.slug}?boek=${book.id}`;

const isMobile = computed(() => useWindowSize().width.value < 640);
</script>

<style lang="css" scoped>
/* Same shelf as BookShelf.vue, scaled by 2/3 to match h-40 covers (vs h-60) */
.shelf {
  background-size: 100% 194px;
  background-repeat: repeat-y;
  background-position: 0 -19px;
}
</style>
