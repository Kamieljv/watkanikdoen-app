<template>
  <div>
    <div class="form-group mb-2">
      <div class="w-full text-sm my-2 mb-5 mx-1">
        <Checkbox
          id="hasNoLatLng"
          v-model="hasNoLatLng"
          :binary="true"
          name="hasNoLatLng"
          class="mr-2"
        />
        <label for="hasNoLatLng" class="text-sm text-gray-900">
          {{
            __("reports.has_no_latlng") ??
            "Deze actie heeft geen specifieke locatie."
          }}
        </label>
      </div>
      <form-autocomplete
        v-if="!hasNoLatLng"
        ref="geoSearch"
        :items="geoSuggestions"
        :is-async="true"
        placeholder="Zoek een adres..."
        @change="getGeoSuggestions"
        @input="getCoordinates"
      />
    </div>

    <l-map
      v-if="!hasNoLatLng && leafletCenter"
      id="map"
      class="rounded-sm"
      :zoom="mapZoom"
      :center="leafletCenter"
      :options="{ dragging: !disabled, scrollWheelZoom: !disabled }"
    >
      <l-tile-layer :url="url" :attribution="attribution" />
      <l-marker
        :lat-lng="leafletCenter"
        :draggable="!disabled"
        @update:lat-lng="onMarkerDrag"
      >
        <l-tooltip v-if="!disabled" :options="tooltipOptions">
          Sleep mij naar de locatie.
        </l-tooltip>
      </l-marker>
    </l-map>
  </div>
</template>

<script setup lang="ts">
import FormAutocomplete from "./FormAutocomplete.vue";

import { ref, computed, watch, inject, Ref } from "vue";
import axios from "axios";
const __: (key: string) => string = inject("translate");
const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
  defaultCenter: {
    // [lng, lat] format
    type: Array as () => number[],
    required: true,
  },
  zoom: {
    type: Number,
    required: true,
  },
  fieldname: {
    type: String,
    required: true,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  unedited: {
    type: Boolean,
    default: true,
  },
});

// center is stored as [lng, lat]
const center: Ref<(number | null)[]> = ref([...props.defaultCenter]);
// Leaflet accepts [lat, lng] arrays — inverted from our [lng, lat]
const leafletCenter = computed(() =>
  center.value[0] != null && center.value[1] != null
    ? [center.value[1], center.value[0]]
    : null
);
const url = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
const attribution =
  '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors';

const mapZoom = ref(props.zoom);
const geoSuggestions = ref([]);
const tooltipOptions = ref({
  permanent: true,
});

const hasNoLatLng = ref(false);

watch(center, (value) => {
  emit("update:modelValue", value);
});

const onMarkerDrag = (event) => {
  center.value = [event.lng, event.lat];
};

const getGeoSuggestions = async (geoQuery) => {
  axios
    .get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/suggest", {
      params: {
        q: geoQuery,
        rows: 5,
        fl: "id,weergavenaam",
        fq: "type:adres",
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
        // PDOK returns "POINT(lng lat)" — split directly gives [lng, lat]
        const coords = pointString.slice(6, pointString.length - 1).split(" ");
        center.value = [parseFloat(coords[0]), parseFloat(coords[1])];
        mapZoom.value = 17;
      });
  }
};
</script>

<style lang="scss" scoped>
#map {
  height: 400px !important;
  width: 100% !important;
}
.leaflet-top.leaflet.left {
  z-index: 400;
}
</style>
