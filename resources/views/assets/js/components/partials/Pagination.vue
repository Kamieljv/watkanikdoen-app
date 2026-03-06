<template>
  <div v-if="pages.length > 1" class="min-w-max">
    <section
      class="flex justify-center bg-white px-10 py-3 text-gray-700 font-montserrat"
    >
      <ul class="flex items-center">
        <li v-if="hasPrev" class="pr-6">
          <a href="#" @click.prevent="changePage(prevPage)">
            <div
              class="flex items-center justify-center hover:bg-gray-200 rounded-full transform h-6 w-6"
            >
              <div class="transform">
                <svg
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  />
                </svg>
              </div>
            </div>
          </a>
        </li>
        <li v-if="hasFirst" class="pr-6">
          <a href="#" @click.prevent="changePage(1)">
            <div
              class="flex hover:bg-gray-200 rounded-full transform h-6 w-6 items-center justify-center"
            >
              <span class="transform"> 1 </span>
            </div>
          </a>
        </li>
        <li v-if="hasFirst" class="pr-6">...</li>
        <li v-for="page in pages" :key="page" class="pr-6">
          <a href="#" @click.prevent="changePage(page)">
            <div
              :class="{
                'text-white bg-(--wkid-pink)': current == page,
              }"
              class="flex hover:bg-gray-200 rounded-full transform h-6 w-6 items-center justify-center"
            >
              <span class="transform">{{ page }}</span>
            </div>
          </a>
        </li>
        <li v-if="hasLast" class="pr-6">...</li>
        <li v-if="hasLast" class="pr-6">
          <a href="#" @click.prevent="changePage(totalPages)">
            <div
              class="flex hover:bg-gray-200 rounded-full transform h-6 w-6 items-center justify-center"
            >
              <span class="transform">
                {{ totalPages }}
              </span>
            </div>
          </a>
        </li>
        <li v-if="hasNext" class="pr-6">
          <a href="#" @click.prevent="changePage(nextPage)">
            <div
              class="flex items-center justify-center hover:bg-gray-200 rounded-full transform h-6 w-6"
            >
              <div class="transform">
                <svg
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  />
                </svg>
              </div>
            </div>
          </a>
        </li>
      </ul>
    </section>
  </div>
</template>

<script setup lang="ts">
import { computed } from "vue";
const emit = defineEmits(["page-changed"]);

const props = defineProps({
  current: {
    type: Number,
    default: 1,
  },
  total: {
    type: Number,
    default: 0,
  },
  perPage: {
    type: Number,
    default: 9,
  },
  pageRange: {
    type: Number,
    default: 2,
  },
  textBeforeInput: {
    type: String,
    default: "Go to page",
  },
  textAfterInput: {
    type: String,
    default: "Go",
  },
});

const hasFirst = computed(() => {
  return props.current !== 1;
});
const hasLast = computed(() => {
  return rangeEnd.value < totalPages.value;
});

const hasPrev = computed(() => {
  return props.current > 1;
});

const hasNext = computed(() => {
  return props.current < totalPages.value;
});

const changePage = (page: number) => {
  if (page > 0 && page <= totalPages.value) {
    emit("page-changed", page);
  }
};

const pages = computed(() => {
  const pages = [];
  for (let i = rangeStart.value; i <= rangeEnd.value; i++) {
    pages.push(i);
  }
  return pages;
});

const rangeStart = computed(() => {
  const start = props.current - props.pageRange;
  return start > 0 ? start : 1;
});

const rangeEnd = computed(() => {
  const end = props.current + props.pageRange;
  return end < totalPages.value ? end : totalPages.value;
});

const totalPages = computed(() => {
  return Math.ceil(props.total / props.perPage);
});

const nextPage = computed(() => {
  return props.current + 1;
});

const prevPage = computed(() => {
  return props.current - 1;
});
</script>

<style scoped></style>
