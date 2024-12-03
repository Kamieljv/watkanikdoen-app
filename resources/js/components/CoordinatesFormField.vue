<template>
    <div>
        <div class="form-group mb-2">
			<div class="w-full text-sm my-2 mb-5 mx-1">
				<div v-if="frontend">
					<Checkbox v-model="hasNoLatLng" :binary="true" name="hasNoLatLng" id="hasNoLatLng" class="mr-2" />
					<label for="hasNoLatLng" class="text-sm text-gray-900">
						{{__("reports.has_no_latlng") ?? "Deze actie heeft geen specifieke locatie."}}
					</label>
				</div>
				<div v-else>
					<input v-model="hasNoLatLng" type="checkbox" name="hasNoLatLng" id="hasNoLatLng" class="mr-2" />
					<label for="hasNoLatLng" class="text-sm text-gray-900">
						{{__("reports.has_no_latlng") ?? "Deze actie heeft geen specifieke locatie."}}
					</label>
				</div>
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

<script setup lang="ts">
// Load formfield
import FormAutocomplete from '../../views/assets/js/components/formfields/FormAutocomplete.vue'

import { latLng } from "leaflet"
import { ref, watch } from "vue"
import axios from 'axios';
import _ from 'lodash';
const __ = str => _.get(window.i18n, str)

const emit = defineEmits(['input'])

const props = defineProps({
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
})

const center = ref(props.defaultCenter[0])
const url = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
const attribution = "&copy; <a href=\"http://osm.org/copyright\">OpenStreetMap</a> contributors"
const lat = ref(center.value.lat)
const lng = ref(center.value.lng)
const mapZoom = ref(props.zoom)
const geoSuggestions = ref([])
const tooltipOptions = ref({
	permanent: true,
})
const hasNoLatLng = ref((props.unedited && !props.frontend) || (!props.unedited && (!lat.value || !lng.value)))

const latName = ref(props.fieldname + "[lat]")
const lngName = ref(props.fieldname + "[lng]")
const coordinates = ref("")

watch(hasNoLatLng, (newVal) => {
	if (newVal) {
		lat.value = null
		lng.value = null
	} else {
		lat.value = props.defaultCenter[0].lat
		lng.value = props.defaultCenter[0].lng
	}
	center.value = latLng(lat.value, lng.value)
})

watch(center, (value) => {
	emit('input', value)
})

const setLatLng = (latitude, longitude) => {
	lat.value = latitude
	lng.value = longitude
}

const onMarkerDrag = (latLng) => {
	setLatLng(latLng.lat, latLng.lng)
	moveMapAndMarker(lat.value, lng.value)
}

const onInputKeyPress = (event) => {
	if (event.which === 13){
		event.preventDefault()
	}
}

const onLatLngInputChange = (event) => {
	moveMapAndMarker(lat.value, lng.value)
}


const moveMapAndMarker = (lat, lng) => {
	center.value = latLng(lat, lng)
}

const getGeoSuggestions = async (geoQuery) => {
	axios.get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/suggest", {
		params: {
			q: geoQuery,
			rows: 5,
			fl: "id,weergavenaam",
			fq: "type:adres",
		}
	}).then((data) => {
		geoSuggestions.value = Object.keys(data.data.highlighting).map((key) => {
			return {
				id: key,
				name: data.data.highlighting[key].suggest[0]
			}
		})
	})
}

const getCoordinates = async (obj) => {
	if (obj !== "") {
		axios.get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/lookup", {
			params: {
				id: obj.id,
				fl: 'centroide_ll',
			}
		}).then((data) => {
			let pointString = data.data.response.docs[0].centroide_ll
			coordinates.value = pointString.slice(6,pointString.length-1).split(" ").reverse()
			center.value = latLng(coordinates.value[0], coordinates.value[1])
			mapZoom.value = 17
		})
	} else {
		coordinates.value = ""
	}
}
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
