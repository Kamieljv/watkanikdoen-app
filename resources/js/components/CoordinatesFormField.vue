<template>
    <div>
        <div class="form-group">
            <div class="col-md-6" v-if="showAutocomplete">
                <!-- <label class="control-label">Zoek locatie</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Zoek een locatie..."
                    id="places-autocomplete"
                    v-on:keypress="onInputKeyPress"
                /> -->
            </div>
            <div class="col-md-3" v-if="showLatLng">
                <label class="control-label">Lat (°N)</label>
                <input
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
            <div class="col-md-3" v-if="showLatLng">
                <label class="control-label">Lon (°O)</label>
                <input
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
            id="map"
            :zoom="zoom"
            :center="center"
        >
            <l-tile-layer
                :url="url"
                :attribution="attribution"
            />
            <l-marker 
                :lat-lng="center"
                :draggable="true"
                @update:latLng="onMarkerDrag">
                <l-tooltip
                    :options="tooltipOptions"
                >
                    Beweeg deze pin naar de gewenste locatie.
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
    // fix marker shadows
    import * as L from 'leaflet'
    delete L.Icon.Default.prototype._getIconUrl
    L.Icon.Default.mergeOptions({
        iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png').default,
        iconUrl: require('leaflet/dist/images/marker-icon.png').default,
        shadowUrl: require('leaflet/dist/images/marker-shadow.png').default,
    })

    import { latLng } from "leaflet";
    export default {
        name: 'CoordinatesFormField',
        props: {
            defaultCenter: {
                type: Array,
                required: true,
            },
            showAutocomplete: {
                type: Boolean,
                default: true,
            },
            showLatLng: {
                type: Boolean,
                default: true,
            },
            zoom: {
                type: Number,
                required: true,
            },
            fieldname: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                center: this.defaultCenter[0],
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution:
                    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                lat: '',
                lng: '',
                tooltipOptions: {
                    permanent: true,
                }
            };
        },
        computed: {
            latName() {
                return this.fieldname + '[lat]'
            },
            lngName() {
                return this.fieldname + '[lng]'
            }
        },
        mounted() {
            this.lat = this.defaultCenter[0].lat;
            this.lng = this.defaultCenter[0].lng;
        },
        methods: {
            setLatLng: function(lat, lng) {
                this.lat = lat;
                this.lng = lng;
            },
            onMarkerDrag: function(latLng) {
                this.setLatLng(latLng.lat, latLng.lng);
                this.moveMapAndMarker(this.lat, this.lng);
            },
            onInputKeyPress: function(event) {
                if (event.which === 13) {
                    event.preventDefault();
                }
            },
            onLatLngInputChange: function(event) {
                this.moveMapAndMarker(this.lat, this.lng);
            },
            moveMapAndMarker: function(lat, lng) {
                this.center = latLng(lat, lng);
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

