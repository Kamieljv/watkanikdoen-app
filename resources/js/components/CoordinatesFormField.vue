<template>
    <div>
        <div class="form-group mb-2">
			<div class="w-full text-sm my-2 mb-5 mx-1">
				<label>
					<input name="hasNoLatLng" v-model="hasNoLatLng" type="checkbox"/>
					Deze actie heeft geen specifieke locatie.
				</label>
			</div>
            <form-autocomplete
				v-if="!hasNoLatLng"
				ref="geoSearch"
				:items="geoSuggestions"
				:isAsync="true"
				@change="getGeoSuggestions"
				@input="getCoordinates"
				placeholder="Zoek een adres..."
			/>
            <div v-if="showLatLng && !hasNoLatLng" class="w-full">
                <label class="control-label">Lat (°N)</label>
                <input
					:disabled="disabled"
                    class="form-control"
                    type="number"
                    step="any"
                    :name="latName"
                    :placeholder="latName"
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
                    :placeholder="lngName"
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
            :zoom="mapZoom"
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

// Load formfield
import FormAutocomplete from '../../views/assets/js/components/formfields/FormAutocomplete'

import { latLng } from "leaflet"
export default {
	name: "CoordinatesFormField",
	props: {
		defaultCenter: {
			type: Array,
			required: true,
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
	components: {"form-autocomplete": FormAutocomplete},
	data() {
		return {
			center: this.defaultCenter[0],
			url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
			attribution:
                    "&copy; <a href=\"http://osm.org/copyright\">OpenStreetMap</a> contributors",
			lat: null,
			lng: null,
			mapZoom: 10,
			geoSuggestions: [],
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
		this.hasNoLatLng = (this.unedited && !this.frontend) || (!this.unedited && (!this.lat || !this.lng))
		this.mapZoom = this.zoom
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
			this.center = latLng(this.lat, this.lng)
		},
		center: {
			handler: function(value) {
				this.$emit('input', value)
			}, 
			deep: true
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
		async getGeoSuggestions(geoQuery) {
			axios.get("https://geodata.nationaalgeoregister.nl/locatieserver/v3/suggest", {
				params: {
					q: geoQuery,
					rows: 5,
					fl: "id,weergavenaam",
					fq: "type:adres",
				}
			}).then((data) => {
				this.geoSuggestions = Object.keys(data.data.highlighting).map((key) => {
					return {
						id: key,
						name: data.data.highlighting[key].suggest[0]
					}
				})
			})
		},
		async getCoordinates(obj) {
			if (obj !== "") {
				axios.get("https://geodata.nationaalgeoregister.nl/locatieserver/v3/lookup", {
					params: {
						id: obj.id,
						rows: 1,
					}
				}).then((data) => {
					let pointString = data.data.response.docs[0].centroide_ll
					this.coordinates = pointString.slice(6,pointString.length-1).split(" ").reverse()
					this.center = latLng(this.coordinates[0], this.coordinates[1])
					this.mapZoom = 17
				})
			} else {
				this.coordinates = ""
			}
		}
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
