<template>
    <div>
        <div v-if="filterable" class="row mx-auto max-w-6xl">
            <div id="filter-container" class="row my-3">
                <h3 class="mt-8 mb-3 text-sm text-gray-900">Zoek & Filter</h3>
                <div id="filter-wrapper" class="col grid gap-3 grid-cols-2 md:grid-cols-4">
                    <div>
                        <t-input
                            type="text"
                            placeholder="Zoeken..."
                            :autofocus="true"
                            v-model="query"
                            @input="processQuery"
                        />
                    </div>
                    <t-rich-select
                        id="theme-selector"
                        :options="themes"
                        textAttribute="name"
                        v-model="themesSelected"
                        :multiple="true"
                        :hideSearchBox="true"
                        :closeOnSelect="false"
                        placeholder="Thema..."
                    />
                    <form-autocomplete
                        :items="geoSuggestions"
                        :isAsync="true"
                        @change="getGeoSuggestions"
                        @input="getCoordinates"
                        placeholder="Plaatsnaam"
                    />
                    <form-slider
                        thumbColor="var(--wkid-blue)"
                        progressColor="var(--wkid-blue)"
                        unit="km"
                        :min="10"
                        :max="150"
                        v-model="distance"
                        :currentValue="defaultDistance"
                        :delay="400"
                        :disabled="!coordinatesPresent"
                    />
                </div>
            </div>
        </div>
        <div class="row mx-auto max-w-6xl mb-8" >
            <div class="col" style="width: 100%">
                <div class="relative mx-auto w-full">
                    <div class="absolute inset-0">
                        <div class="bg-white h-1/3 sm:h-2/3"></div>
                    </div>
                    <div class="relative mx-auto max-w-7xl">
                        <div
                            class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                            v-if="!isGeladen"
                        >
                            <t-card
                                v-for="i in skeletonArray"
                                :key="i"
                                variant="skeleton"
                                class="rounded-lg shadow-md overflow-hidden"
                            >
                                <template v-slot:header>
                                    <div class="h-6 w-20 inline-block bg-gray-100 rounded"/>
                                </template>
                                <div class="relative h-6 w-full inline-block bg-gray-200 rounded"></div>
                                <div class="relative h-3 w-full inline-block bg-gray-200 rounded"></div>

                                <template v-slot:footer >
                                    <div class="rounded-full bg-gray-200 h-10 w-10"></div>
                                </template>
                            </t-card>
                        </div>
                        <div
                            v-else-if="heeftActies"
                            class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                        >
                            <actie
                                v-for="actie in actiesFormatted"
                                :key="actie.id"
                                :actie="actie"
                            />
                        </div>
						<div v-else-if="isGeladen" class="flex justify-center items-center py-8">
							<div class="text-gray-400">
								<h3>{{__('general.no_results')}}</h3>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <pagination
            :current="currentPage"
            :total="total"
            :per-page="perPage"
            :baseLink="base_link"
            @page-changed="getActies"
        />
    </div>
</template>

<script>
import { geoHelper } from "../mixins/geoHelper"
import Pagination from "./Pagination.vue"
export default {
	name: "ActieAgenda",
	components: {Pagination},
	mixins: [geoHelper],
	props: {
		routes: {
			type: Object,
			required: true,
		},
		themes: {
			type: Array,
			default: () => [],
		},
		filterable: {
			type: Boolean,
			default: true,
		},
		organizerId: {
			type: Number,
			default: null,
		}
	},
	data() {
		return {
			acties: [],
			themesSelected: "",
			query: "",
			coordinates: "",
			distance: null,
			defaultDistance: 100,
			geoSuggestions: [],
			isGeladen: false,
			heeftFout: false,
			currentPage: null,
			perPage: null,
			total: null,
			base_link: null,
		}
	},
	computed: {
		sliderArray() {
			return [...Array(10+1).keys()].slice(1).map((v) => {return v * stepSize})
		},
		skeletonArray() {
			return [...Array(10).keys()]
		},
		heeftActies() {
			return (this.acties.length > 0)
		},
		actiesFormatted() {
			this.acties.forEach((actie) => {
				actie.body = actie.body.replace(/(<([^>]+)>)/gi, "")
				if (actie._geoloc && this.coordinates !== "") {
					let coordinates = this.coordinates.split(",")
					// calculate distance to actie in km
					actie.distance = this.calcDistance(actie._geoloc.lat, actie._geoloc.lng,
						coordinates[0], coordinates[1]).toFixed(1)
				} else {
					actie.distance = null
				}
				return actie
			})
			return this.acties
		},
		coordinatesPresent() {
			return this.coordinates !== ""
		}
	},
	watch: {
		query: function() {
			this.getActies()
		},
		themesSelected: function() {
			this.getActies()
		},
		distance: function() {
			this.getActies()
		},
		coordinates: function() {
			this.distance = (this.distance === null)? this.defaultDistance : this.distance
		}
	},
	mounted() {
		this.getActies()
	},
	methods: {
		getActies: _.debounce(async function getActies(page = 1) {
			this.isGeladen = false
			this.heeftFout = false
			axios.get(this.routes["acties.search"].uri, {
				params: {
					q: this.query,
					themes: this.themesSelected,
					coordinates: this.coordinates,
					distance: this.distance,
					page: page,
					organizer: this.organizerId,
				}
			}).then((response) => {
				this.acties = response.data.acties.data
				this.currentPage = response.data.acties.current_page
				this.perPage = response.data.acties.per_page
				this.total = response.data.acties.total
				this.base_link = response.data.acties.first_page_url
			}).catch((error) => {
				this.heeftFout = true
			}).finally(() => {
				this.isGeladen = true
			})
		}, 500),
		processQuery: _.debounce(function(input) {
			this.query = input
		}, 500),
		async getGeoSuggestions(geoQuery) {
			axios.get("https://geodata.nationaalgeoregister.nl/locatieserver/v3/suggest", {
				params: {
					q: geoQuery,
					rows: 5,
					fl: "id,weergavenaam",
					fq: "type:woonplaats",
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
			this.isGeladen = false
			if (obj !== "") {
				axios.get("https://geodata.nationaalgeoregister.nl/locatieserver/v3/lookup", {
					params: {
						id: obj.id,
						rows: 1,
					}
				}).then((data) => {
					let pointString = data.data.response.docs[0].centroide_ll
					this.coordinates = pointString.slice(6,pointString.length-1).split(" ").reverse().join(",")
					this.getActies()
				})
			} else {
				this.coordinates = ""
				this.getActies()
			}
		}
	}
}
</script>

