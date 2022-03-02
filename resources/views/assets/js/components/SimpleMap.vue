<template>
    <l-map
		id="map"
		:zoom="zoom"
		:center="center"
		:style="{height: height}"
		:options="mapOptions"
	>
		<l-tile-layer
			:url="url"
			:attribution="attribution"
		/>
		<l-marker
			:lat-lng="center"
		>
		</l-marker>
	</l-map>
</template>

<script>
// fix marker shadows
import * as L from "leaflet"
delete L.Icon.Default.prototype._getIconUrl
L.Icon.Default.mergeOptions({
	iconRetinaUrl: require("leaflet/dist/images/marker-icon-2x.png").default,
	iconUrl: require("leaflet/dist/images/marker-icon.png").default,
	shadowUrl: require("leaflet/dist/images/marker-shadow.png").default,
})

export default {
	name: "SimpleMap",
	props: {
		center: {
			type: Object,
			required: true,
		},
		height: {
			type: String,
			required: true,
		}
	},
	data() {
		return {
			zoom: 10,
			url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
			attribution:
        "&copy; <a href=\"http://osm.org/copyright\">OpenStreetMap</a> contributors",
			mapOptions: {
				zoomControl: false,
			},
		}
	},
}
</script>
