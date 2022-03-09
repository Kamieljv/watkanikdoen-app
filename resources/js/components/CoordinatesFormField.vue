<template>
    <div>
        <div class="form-group">
			<div class="w-full text-sm my-2 mx-1">
				<label>
					<input name="hasNoLatLng" v-model="hasNoLatLng" type="checkbox"/>
					Deze actie heeft geen specifieke locatie.
				</label>
			</div>
            <!-- <div class="col-md-6" v-if="showAutocomplete">
                <label class="control-label">Zoek locatie</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Zoek een locatie..."
                    id="places-autocomplete"
                    v-on:keypress="onInputKeyPress"
                />
            </div> -->
            <div v-if="showLatLng && !hasNoLatLng" class="w-full">
                <label class="control-label">Lat (°N)</label>
                <input
					:disabled="disabled"
                    class="form-control"
                    type="number"
                    step="any"
                    :name="latName"
                    placeholder="19.6400"
                    v-model="lat"
                    @change="onLatLngInputChange"
                    v-on:keypress="onInputKeyPress"
                />
            </div>
            <div v-if="showLatLng && !hasNoLatLng" class="w-full">
                <label class="control-label">Lon (°O)</label>
                <input
					:disabled="disabled"
                    class="form-control"
                    type="number"
                    step="any"
                    :name="lngName"
                    placeholder="-155.9969"
                    v-model="lng"
                    @change="onLatLngInputChange"
                    v-on:keypress="onInputKeyPress"
                />
            </div>

            <div class="clearfix"></div>
        </div>

        <l-map
			v-if="!hasNoLatLng"
            id="map"
            :zoom="zoom"
            :center="center"
			:options="{dragging: !disabled, scrollWheelZoom: !disabled}"
        >
            <l-tile-layer
                :url="url"
                :attribution="attribution"
            />
            <l-marker 
                :lat-lng="center"
                :draggable="!disabled"
                @update:latLng="onMarkerDrag">
                <l-tooltip
                    :options="tooltipOptions"
					v-if="!disabled"
                >
                    Sleep mij naar de locatie.
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
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

import { latLng } from "leaflet"
export default {
	name: "CoordinatesFormField",
	props: {
		defaultCenter: {
			type: Array,
			required: true,
		},
		showAutocomplete: {
			type: Boolean,
			default: false,
		},
		showLatLng: {
			type: Boolean,
			default: false,
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
		frontend: {
			type: Boolean,
			default: false,
		}
	},
	data() {
		return {
			center: this.defaultCenter[0],
			url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
			attribution:
                    "&copy; <a href=\"http://osm.org/copyright\">OpenStreetMap</a> contributors",
			lat: "",
			lng: "",
			tooltipOptions: {
				permanent: true,
			},
			hasNoLatLng: false,
		}
	},
	computed: {
		latName() {
			return this.fieldname + "[lat]"
		},
		lngName() {
			return this.fieldname + "[lng]"
		}
	},
	mounted() {
		this.hasNoLatLng = this.unedited && !this.frontend
	},
	watch: {
		hasNoLatLng: function(newVal) {
			if (newVal) {
				this.lat = null
				this.lng = null
			} else {
				this.lat = this.defaultCenter[0].lat
				this.lng = this.defaultCenter[0].lng
			}
		}
	},
	methods: {
		setLatLng: function(lat, lng) {
			this.lat = lat
			this.lng = lng
		},
		onMarkerDrag: function(latLng) {
			this.setLatLng(latLng.lat, latLng.lng)
			this.moveMapAndMarker(this.lat, this.lng)
		},
		onInputKeyPress: function(event) {
			if (event.which === 13) {
				event.preventDefault()
			}
		},
		onLatLngInputChange: function(event) {
			this.moveMapAndMarker(this.lat, this.lng)
		},
		moveMapAndMarker: function(lat, lng) {
			this.center = latLng(lat, lng)
		},
	}
}
</script>

<style lang="scss" scoped>
    #map {
        height: 400px;
        width: 100%;
    }
    .leaflet-top.leaflet.left {
        z-index: 400;
    }
</style>

