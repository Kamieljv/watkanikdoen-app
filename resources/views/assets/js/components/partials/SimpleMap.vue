<template>
  <l-map
    id="map"
    :zoom="zoom"
    :center="props.center"
    :style="{ height: height }"
    :options="mapOptions"
  >
    <l-tile-layer :url="url" :attribution="attribution" />
    <l-marker :lat-lng="props.center"> </l-marker>
  </l-map>
</template>

<script setup lang="ts">
import { ref } from "vue";

const props = defineProps({
  center: {
    type: Array,
    required: true,
  },
  height: {
    type: String,
    required: true,
  },
});
const zoom = ref(10);
const url = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
const attribution =
  '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors';
const mapOptions = {
  dragging: false,
  scrollWheelZoom: "center",
};
</script>
