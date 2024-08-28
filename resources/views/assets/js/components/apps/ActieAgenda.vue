<template>
    <div>
        <div v-if="filterable" class="row mx-auto max-w-6xl">
            <div id="filter-container" class="row my-3">
				<Collapsible 
					id="filter-collapsible"
					triggerLabel="Zoek & Filter"
					icon="clarity-filter-solid"
					:notification-count="filterCount"
					:isOpen="false"
				>
					<div id="filter-wrapper" class="col grid gap-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-5">
						<FormField
                            v-model="query"
							:value="query"
                            name="query"
                            type="text"
							placeholder="Zoeken..."
                            @input="processQuery"
							:clearable="true"
							classes="block w-full h-full px-3 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed text-black placeholder-gray-400 bg-white border-gray-300 focus:border-blue-500"
                        />
						<t-rich-select
							id="theme-selector"
							:options="themes"
							textAttribute="name"
							v-model="themesSelected"
							:multiple="true"
							:closeOnSelect="false"
							searchBoxPlaceholder="Zoeken..."
							:minimumResultsForSearch="5"
							placeholder="Thema..."
						/>
						<t-rich-select
							id="category-selector"
							:options="categories"
							textAttribute="name"
							v-model="categoriesSelected"
							:multiple="true"
							:closeOnSelect="false"
							searchBoxPlaceholder="Zoeken..."
							:minimumResultsForSearch="5"
							placeholder="Categorie..."
						/>
						<form-autocomplete
							ref="geoSearch"
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
						<div class="flex items-center space-x-3">
							<t-toggle
								v-model="showPast"
								name="showPast"
							/>
							<label class="text-sm text-gray-600" for="showPast">Toon ook acties in het verleden</label>
						</div>
						<button v-on:click="resetFilters" v-if="filterCount" class="gray uppercase">
							Filter(s) wissen
						</button>
					</div>
				</Collapsible>
            </div>
        </div>
        <div class="row mx-auto max-w-6xl mb-8" >
            <div class="col" style="width: 100%">
                <div class="relative mx-auto w-full">
                    <div class="relative mx-auto max-w-7xl">
                        <div
                            class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
							:class="{'xl:grid-cols-2 lg:grid-cols-2': narrower}"
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
							:class="{'xl:grid-cols-2 lg:grid-cols-2': narrower}"
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
import { geoHelper } from "../../mixins/geoHelper"
import Pagination from "../partials/Pagination.vue"
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
		themesSelectedIds: {
			type: Array,
			default: () => [],
		},
		categories: {
			type: Array,
			default: () => [],
		},
		categoriesSelectedIds: {
			type: Array,
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
		themeIds: {
			type: Array,
			default: () => [],
		},
		excludeIds: {
			type: Array,
			default: () => [],
		},
		skeletons: {
			type: Number,
			default: 10,
		},
		limit: {
			type: Number,
			default: null,
		}
	},
	data() {
		return {
			acties: [],
			themesSelected: null,
			categoriesSelected: "",
			query: "",
			coordinates: "",
			distance: null,
			defaultDistance: 100,
			geoSuggestions: [],
			showPast: false,
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
			return [...Array(this.skeletons).keys()]
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
		},
		filterCount() {
			var filters = [this.query, this.themesSelected, this.categoriesSelected, this.coordinates, this.showPast]
			return filters.filter(f => (!!f && !(f.length === 0))).length
		}
	},
	watch: {
		query: function() {
			this.getActies()
		},
		themesSelected: function() {
			this.getActies()
		},
		categoriesSelected: function() {
			this.getActies()
		},
		distance: function() {
			this.getActies()
		},
		showPast: function() {
			this.getActies()
		},
		coordinates: function() {
			this.distance = (this.distance === null)? this.defaultDistance : this.distance
		}
	},
	mounted() {
		this.themesSelected = this.themes.filter(t => this.themesSelectedIds.includes(t.id)).map(t => t.id);
		this.categoriesSelected = this.categories.filter(c => this.categoriesSelectedIds.includes(c.id)).map(c => c.id);
		this.getActies()
	},
	methods: {
		getActies: _.debounce(async function getActies(page = 1) {
			this.isGeladen = false
			this.heeftFout = false
			axios.get(this.routes["acties.search"].uri, {
				params: {
					q: this.query,
					themes: this.themesSelected ?? this.themeIds,
					categories: this.categoriesSelected,
					coordinates: this.coordinates,
					distance: this.distance,
					show_past: this.showPast,
					page: page,
					organizer: this.organizerId,
				}
			}).then((response) => {
				this.acties = this.processActiesArray(response.data.acties.data)
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
		processActiesArray: function(acties) {
			return acties.filter((a) => !this.excludeIds.includes(a.id)).slice(0, this.limit ?? 999)
		},
		processQuery: _.debounce(function(input) {
			this.query = input
		}, 500),
		async getGeoSuggestions(geoQuery) {
			axios.get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/suggest", {
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
				axios.get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/lookup", {
					params: {
						id: obj.id,
						fl: 'centroide_ll',
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
		},
		resetFilters() {
			this.themesSelected = []
			this.categoriesSelected = []
			this.query = ""
			this.$refs.geoSearch.resetResult()
			this.showPast = false
		}
	}
}
</script>

