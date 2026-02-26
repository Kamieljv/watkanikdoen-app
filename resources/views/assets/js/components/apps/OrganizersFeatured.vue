<template>
  <div>
    <div class="row mx-auto max-w-6xl">
      <div class="col" style="width: 100%">
        <div class="relative mx-auto w-full">
          <div class="relative mx-auto max-w-7xl">
            <div v-if="!isGeladen">
              <div
                v-for="i in skeletonArray"
                :key="i"
                class="animate-pulse flex p-3 justify-between border border-gray-200 mb-1 rounded-lg shadow-md"
              >
                <div class="flex space-x-3 w-full justify-start items-center">
                  <div
                    class="flex w-16 h-16 shrink-0 rounded-full bg-gray-200"
                  ></div>
                  <div class="flex flex-col w-full">
                    <div
                      class="relative h-6 w-1/3 mb-1 inline-block bg-gray-200 rounded"
                    ></div>
                    <div
                      class="relative h-4 w-full inline-block bg-gray-200 rounded"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
            <div v-else-if="heeftOrganizers">
              <organizer
                v-for="organizer in organizersFormatted"
                :key="organizer.id"
                :organizer="organizer"
                :route="organizerBaseRoute + organizer.slug"
                :show-themes="showThemes"
                :type="'large'"
              />
            </div>
            <div
              v-else-if="isGeladen"
              class="flex justify-center items-center py-8"
            >
              <div class="text-gray-400">
                <h3>{{ __("general.no_results") }}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, inject, onMounted, ref } from "vue";
import axios from "axios";
const __: (key: string) => string = inject("translate");

const props = defineProps({
  routes: {
    type: Object,
    required: true,
  },
  showThemes: {
    type: Boolean,
    default: true,
  },
  max: {
    type: Number,
    default: 3,
  },
});

const organizers = ref([]);
const isGeladen = ref(false);
const hasError = ref(false);

const skeletonArray = ref([...Array(3).keys()]);

const heeftOrganizers = computed(() => {
  return organizers.value.length > 0;
});
const organizersFormatted = computed(() => {
  organizers.value.forEach((organizer) => {
    organizer.description = organizer.description
      ? organizer.description.replace(/(<([^>]+)>)/gi, "")
      : null;
    return organizer;
  });
  return organizers.value;
});
const organizerBaseRoute = computed(() => {
  return props.routes["organizers.organizer"].uri.split("{")[0];
});

onMounted(() => {
  getOrganizers();
});

const getOrganizers = async function getOrganizers() {
  isGeladen.value = false;
  hasError.value = false;
  try {
    const response = await axios.get(props.routes["organizers.search"].uri, {
      params: {
        limit: props.max,
        onlyFeatured: true,
      },
    });
    organizers.value = response.data.organizers;
  } catch (error) {
    hasError.value = true;
    console.error(error);
  } finally {
    isGeladen.value = true;
  }
};
</script>
