<template>
  <div ref="mapEl" class="w-full h-full"></div>
  <div ref="popupEl" class="actie-map-popup">
    <actie-small
      v-if="actie"
      :actie="actie"
      :target-blank="true"
      :flat="true"
    />
    <div
      v-else
      class="h-[150px] flex items-center justify-center bg-white rounded-lg text-gray-400"
    >
      …
    </div>
  </div>
</template>

<script setup lang="ts">
import { onBeforeUnmount, onMounted, ref } from "vue";
import axios from "axios";
import * as maplibregl from "maplibre-gl";
import "maplibre-gl/dist/maplibre-gl.css";
import ActieSmall from "../partials/ActieSmall.vue";
import { setWorkerUrl } from "maplibre-gl";

interface MapActie {
  id: number;
  slug: string;
  lat: number;
  lng: number;
  colors: string[];
}

const NL_BOUNDS: [[number, number], [number, number]] = [
  [3.0, 50.6],
  [7.5, 53.7],
];
const FALLBACK_COLOR = "#9ca3af";
const PIN_SIZE = 28;

const mapEl = ref<HTMLElement>();
const popupEl = ref<HTMLElement>();
const actie = ref<any>(null);

let map: maplibregl.Map | null = null;
let popup: maplibregl.Popup | null = null;
let requestId = 0;

const CLUSTER_COLOR = "#f30060";

// Pie-chart pin image with one equal slice per theme color.
function pinImage(colors: string[]): ImageData {
  const list = colors.length ? colors : [FALLBACK_COLOR];
  const ratio = 2;
  const size = PIN_SIZE * ratio;
  const canvas = document.createElement("canvas");
  canvas.width = canvas.height = size;
  const ctx = canvas.getContext("2d")!;
  const c = size / 2;
  const border = 2 * ratio;
  const r = c - 2;
  ctx.beginPath();
  ctx.arc(c, c, r, 0, Math.PI * 2);
  ctx.fillStyle = "#fff";
  ctx.shadowColor = "rgba(0,0,0,.45)";
  ctx.shadowBlur = 3 * ratio;
  ctx.fill();
  ctx.shadowColor = "transparent";
  const slice = (Math.PI * 2) / list.length;
  list.forEach((color, i) => {
    ctx.beginPath();
    ctx.moveTo(c, c);
    ctx.arc(
      c,
      c,
      r - border,
      -Math.PI / 2 + i * slice,
      -Math.PI / 2 + (i + 1) * slice,
    );
    ctx.closePath();
    ctx.fillStyle = color;
    ctx.fill();
  });
  return ctx.getImageData(0, 0, size, size);
}

function iconId(colors: string[]): string {
  return `pin-${(colors.length ? colors : [FALLBACK_COLOR]).join("-")}`;
}

async function openPopup(slug: string, lngLat: [number, number]) {
  const id = ++requestId;
  actie.value = null;
  popup!.setLngLat(lngLat).addTo(map!);
  try {
    const { data } = await axios.get(`/api/v1/acties/${slug}/card`);
    if (id === requestId) actie.value = data.data;
  } catch (e) {
    if (id === requestId) popup?.remove();
  }
}

function addActies(acties: MapActie[]) {
  const m = map!;
  const icons = new Set<string>();
  const features = acties.map((a) => {
    const icon = iconId(a.colors);
    if (!icons.has(icon)) {
      icons.add(icon);
      m.addImage(icon, pinImage(a.colors), { pixelRatio: 2 });
    }
    return {
      type: "Feature" as const,
      geometry: { type: "Point" as const, coordinates: [a.lng, a.lat] },
      properties: { slug: a.slug, icon },
    };
  });

  m.addSource("acties", {
    type: "geojson",
    data: { type: "FeatureCollection", features },
    cluster: true,
    clusterMaxZoom: 14,
    clusterRadius: 50,
  });

  m.addLayer({
    id: "clusters-shadow",
    type: "circle",
    source: "acties",
    filter: ["has", "point_count"],
    paint: {
      "circle-color": "#000",
      "circle-opacity": 0.45,
      "circle-radius": [
        "step",
        ["get", "point_count"],
        16,
        10,
        20,
        50,
        26,
        200,
        32,
      ],
      "circle-stroke-width": 3,
      "circle-stroke-color": "#000",
      "circle-stroke-opacity": 0.45,
      "circle-blur": 0.8,
      "circle-translate": [0, 3],
    },
  });
  m.addLayer({
    id: "clusters",
    type: "circle",
    source: "acties",
    filter: ["has", "point_count"],
    paint: {
      "circle-color": CLUSTER_COLOR,
      "circle-radius": [
        "step",
        ["get", "point_count"],
        16,
        10,
        20,
        50,
        26,
        200,
        32,
      ],
      "circle-stroke-width": 3,
      "circle-stroke-color": "#fff",
    },
  });
  m.addLayer({
    id: "cluster-count",
    type: "symbol",
    source: "acties",
    filter: ["has", "point_count"],
    layout: {
      "text-field": "{point_count_abbreviated}",
      "text-font": ["Noto Sans Regular"],
      "text-size": 13,
    },
    paint: { "text-color": "#fff" },
  });
  m.addLayer({
    id: "unclustered-point",
    type: "symbol",
    source: "acties",
    filter: ["!", ["has", "point_count"]],
    layout: {
      "icon-image": ["get", "icon"],
      "icon-allow-overlap": true,
    },
  });

  m.on("click", "clusters", async (e) => {
    const feature = m.queryRenderedFeatures(e.point, {
      layers: ["clusters"],
    })[0];
    const zoom = await (
      m.getSource("acties") as maplibregl.GeoJSONSource
    ).getClusterExpansionZoom(feature.properties.cluster_id);
    m.easeTo({ center: (feature.geometry as any).coordinates, zoom });
  });
  m.on("click", "unclustered-point", (e) => {
    const f = e.features![0];
    const coords = (f.geometry as any).coordinates.slice() as [number, number];
    openPopup(f.properties.slug, coords);
  });
  ["clusters", "unclustered-point"].forEach((layer) => {
    m.on("mouseenter", layer, () => (m.getCanvas().style.cursor = "pointer"));
    m.on("mouseleave", layer, () => (m.getCanvas().style.cursor = ""));
  });
}

onMounted(async () => {
  setWorkerUrl("/js/maplibre/maplibre-gl-worker.mjs");
  map = new maplibregl.Map({
    container: mapEl.value!,
    style: "https://tiles.openfreemap.org/styles/positron",
    bounds: NL_BOUNDS,
    maxBounds: [
      [NL_BOUNDS[0][0] - 1, NL_BOUNDS[0][1] - 1],
      [NL_BOUNDS[1][0] + 1, NL_BOUNDS[1][1] + 1],
    ],
    minZoom: 6,
  });
  map.addControl(new maplibregl.NavigationControl({ showCompass: false }));

  popup = new maplibregl.Popup({
    offset: PIN_SIZE / 2 + 4,
    maxWidth: "380px",
    closeButton: true,
  }).setDOMContent(popupEl.value!);

  try {
    const [{ data }] = await Promise.all([
      axios.get("/api/v1/acties/map"),
      new Promise<void>((resolve) => map!.once("load", () => resolve())),
    ]);
    addActies(data.data as MapActie[]);
  } catch (e) {
    console.error("Could not load map acties", e);
  }
});

onBeforeUnmount(() => map?.remove());
</script>

<style>
.actie-map-popup {
  width: 340px;
  max-width: 100%;
}
.maplibregl-popup-content {
  padding: 0;
  background: transparent;
  box-shadow: none;
}
.maplibregl-popup-close-button {
  display: none;
}
</style>
