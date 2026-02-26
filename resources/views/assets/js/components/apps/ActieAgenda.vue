<template>
  <div>
    <div v-if="filterable" class="row mx-auto max-w-6xl">
      <div id="filter-container" class="row my-3">
        <Collapsible
          id="filter-collapsible"
          trigger-label="Zoek & Filter"
          :notification-count="filterCount"
          :is-open="false"
        >
          <template #icon>
            <FilterIcon class="w-6 h-6 text-gray-500" />
          </template>
          <div
            id="filter-wrapper"
            class="grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-5"
          >
            <FormField
              v-model="query"
              :value="query"
              name="query"
              type="text"
              placeholder="Zoeken..."
              :clearable="true"
              :full-height="true"
              classes="block w-full h-full px-3 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed text-black placeholder-gray-400 bg-white border-gray-300 focus:border-blue-500"
            />
            <MultiSelect
              id="theme-selector"
              v-model="themesSelected"
              :options="themes"
              option-label="name"
              option-value="id"
              placeholder="Thema..."
              filter-placeholder="Zoeken..."
            />
            <MultiSelect
              id="category-selector"
              v-model="categoriesSelected"
              :options="categories"
              option-label="name"
              option-value="id"
              placeholder="Categorie..."
              filter-placeholder="Zoeken..."
            />
            <FormAutocomplete
              ref="geoSearchRef"
              :items="geoSuggestions"
              :is-async="true"
              placeholder="Plaatsnaam"
              @change="getGeoSuggestions"
              @input="getCoordinates"
            />
            <FormSlider
              v-model="distance"
              thumb-color="var(--color-blue-500)"
              progress-color="var(--color-blue-500)"
              :min="10"
              :max="150"
              :delay="400"
              :disabled="!coordinatesPresent"
            />
            <div
              class="col-span-1 sm:col-span-2 md:col-span-5 flex sm:flex-row flex-col sm:h-9 sm:items-center justify-between space-y-3 sm:space-y-0"
            >
              <div class="flex items-center space-x-3">
                <ToggleSwitch v-model="showPast" name="showPast" />
                <label class="text-sm text-gray-600" for="showPast"
                  >Toon ook acties in het verleden</label
                >
              </div>
              <button
                v-if="filterCount"
                class="gray uppercase"
                @click="resetFilters"
              >
                Filter(s) wissen
              </button>
            </div>
          </div>
        </Collapsible>
      </div>
    </div>
    <div class="row mx-auto max-w-6xl mb-8">
      <div class="col" style="width: 100%">
        <div class="relative mx-auto w-full">
          <div class="relative mx-auto max-w-7xl">
            <div
              v-if="!isGeladen && !appending"
              class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
              :class="{ 'xl:grid-cols-2 lg:grid-cols-2': narrower }"
            >
              <div
                v-for="i in skeletonArray"
                :key="i"
                class="rounded-lg shadow-md overflow-hidden animate-pulse"
              >
                <div class="h-48 row-span-1 bg-gray-200"></div>
                <div
                  class="flex flex-col col-span-2 p-3 justify-between flex-1 bg-white"
                >
                  <div
                    class="relative h-6 mb-3 w-full inline-block bg-gray-200 rounded"
                  ></div>
                  <div
                    class="relative h-3 mb-1 w-full inline-block bg-gray-200 rounded"
                  ></div>
                  <div
                    class="relative h-3 mb-1 w-full inline-block bg-gray-200 rounded"
                  ></div>
                  <div
                    class="relative h-6 w-20 inline-block bg-gray-200 rounded mt-3"
                  ></div>
                </div>
              </div>
            </div>
            <div
              v-else-if="heeftActies"
              class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
              :class="{ 'xl:grid-cols-2 lg:grid-cols-2': narrower }"
            >
              <Actie
                v-for="actie in actiesFormatted"
                :key="actie.id"
                :actie="actie"
              />
            </div>
            <div
              v-else-if="isGeladen"
              class="flex flex-col justify-center items-center py-8 text-gray-400"
            >
              <h3>{{ __("general.no_results") }}</h3>
              <div v-if="filterCount" class="flex flex-col items-center">
                <p>
                  {{ __("general.no_results_suggestion_too_many_filters") }}
                </p>
                <button class="gray uppercase mt-2" @click="resetFilters">
                  {{ __("general.clear_filters") }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- see more button -->
    <div
      v-if="
        enableShowMore &&
        heeftActies &&
        total > perPage &&
        currentPage !== lastPage &&
        !appending
      "
      class="flex justify-center"
    >
      <button
        class="btn secondary"
        @click="
          currentPage++;
          appending = true;
          getActies();
        "
      >
        {{ __("general.load_more") }}
      </button>
    </div>
    <div v-else-if="appending" class="flex justify-center">
      <div class="custom-loader dark large"></div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted, watch, computed, ref, inject } from "vue";
import FilterIcon from "&/clarity-filter-solid.svg";
import { calcDistance } from "../../helpers/geoHelper";
import debounce from "lodash/debounce";
import axios from "axios";
import { Theme, Category } from "../../models";
const __: (key: string) => string = inject("translate");

const props = defineProps({
  routes: {
    type: Object,
    required: true,
  },
  themes: {
    type: Array<Theme>,
    default: () => [],
  },
  themesSelectedIds: {
    type: Array<number>,
    default: () => [],
  },
  categories: {
    type: Array<Category>,
    default: () => [],
  },
  categoriesSelectedIds: {
    type: Array<number>,
    default: () => [],
  },
  filterable: {
    type: Boolean,
    default: true,
  },
  narrower: {
    type: Boolean,
    default: false,
  },
  organizerId: {
    type: Number,
    default: null,
  },
  excludeIds: {
    type: Array,
    default: () => [],
  },
  enableShowMore: {
    type: Boolean,
    default: true,
  },
  skeletons: {
    type: Number,
    default: 10,
  },
  limit: {
    type: Number,
    default: null,
  },
});

const acties = ref([]);
const themesSelected = ref(
  props.themes
    .filter((t) => props.themesSelectedIds.includes(t.id))
    .map((t) => t.id),
);
const categoriesSelected = ref(
  props.categories
    .filter((c) => props.categoriesSelectedIds.includes(c.id))
    .map((c) => c.id),
);
const query = ref("");
const coordinates = ref("");
const distance = ref(150);
const geoSuggestions = ref([]);
const showPast = ref(false);
const isGeladen = ref(false);
const appending = ref(false);
const hasError = ref(false);
const currentPage = ref(null);
const lastPage = ref(null);
const perPage = ref(null);
const total = ref(null);
const geoSearchRef = ref(null);

const skeletonArray = computed(() => {
  return [...Array(props.skeletons).keys()];
});

const heeftActies = computed(() => {
  return acties.value.length > 0;
});

const actiesFormatted = computed(() => {
  acties.value.forEach((actie) => {
    actie.body = actie.body.replace(/(<([^>]+)>)/gi, "");
    if (actie.location && coordinates.value !== "") {
      const coordinatesArray = coordinates.value.split(",");
      // calculate distance to actie in km
      actie.distance = calcDistance(
        actie.location.coordinates[1],
        actie.location.coordinates[0],
        coordinatesArray[0],
        coordinatesArray[1],
      ).toFixed(0);
    } else {
      actie.distance = null;
    }
    return actie;
  });
  return acties.value;
});

const coordinatesPresent = computed(() => {
  return coordinates.value !== "";
});

const filterCount = computed(() => {
  const filters: (string | boolean | number[])[] = [
    query.value,
    themesSelected.value,
    categoriesSelected.value,
    coordinates.value,
    showPast.value,
  ];
  return filters.filter(
    (f) => !!f && ((Array.isArray(f) && f.length > 0) || !Array.isArray(f)),
  ).length;
});

watch(query, () => {
  getActies();
});

watch(themesSelected, () => {
  getActies();
});

watch(categoriesSelected, () => {
  getActies();
});

watch(distance, () => {
  getActies();
});

watch(showPast, () => {
  getActies();
});

watch(coordinates, () => {
  getActies();
});

onMounted(() => {
  getActies();
});

const getActies = debounce(() => {
  isGeladen.value = false;
  hasError.value = false;
  axios
    .get(props.routes["acties.search"].uri, {
      params: {
        q: query.value,
        themes: themesSelected.value ? themesSelected.value : null,
        categories: categoriesSelected.value,
        coordinates: coordinates.value,
        distance: distance.value,
        show_past: showPast.value,
        page: currentPage.value,
        organizer: props.organizerId,
      },
    })
    .then((response) => {
      if (appending.value) {
        acties.value = acties.value.concat(
          processActiesArray(response.data.acties.data),
        );
      } else {
        acties.value = processActiesArray(response.data.acties.data);
      }
      currentPage.value = response.data.acties.current_page;
      lastPage.value = response.data.acties.last_page;
      perPage.value = response.data.acties.per_page;
      total.value = response.data.acties.total;
    })
    .catch(() => {
      hasError.value = true;
    })
    .finally(() => {
      isGeladen.value = true;
      appending.value = false;
    });
}, 500);

const processActiesArray = (acties) => {
  return acties
    .filter((a) => !props.excludeIds.includes(a.id))
    .slice(0, props.limit ?? acties.length);
};

const getGeoSuggestions = async (geoQuery) => {
  axios
    .get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/suggest", {
      params: {
        q: geoQuery,
        rows: 5,
        fl: "id,weergavenaam",
        fq: "type:woonplaats",
      },
    })
    .then((data) => {
      geoSuggestions.value = Object.keys(data.data.highlighting).map((key) => {
        return {
          id: key,
          name: data.data.highlighting[key].suggest[0],
        };
      });
    });
};

const getCoordinates = async (obj) => {
  isGeladen.value = false;
  if (obj !== "") {
    axios
      .get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/lookup", {
        params: {
          id: obj.id,
          fl: "centroide_ll",
        },
      })
      .then((data) => {
        const pointString = data.data.response.docs[0].centroide_ll;
        coordinates.value = pointString
          .slice(6, pointString.length - 1)
          .split(" ")
          .reverse()
          .join(",");
      });
  } else {
    coordinates.value = "";
  }
};

const resetFilters = () => {
  themesSelected.value = [];
  categoriesSelected.value = [];
  query.value = "";
  geoSearchRef.value.resetResult();
  showPast.value = false;
};
</script>
