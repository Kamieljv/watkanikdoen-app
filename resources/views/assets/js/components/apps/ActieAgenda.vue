<template>
    <div>
        <div v-if="filterable" class="row mx-auto max-w-6xl">
            <div id="filter-container" class="row my-3">
				<Collapsible 
					id="filter-collapsible"
					triggerLabel="Zoek & Filter"
					:notification-count="filterCount"
					:isOpen="false"
				>
					<template v-slot:icon>
						<FilterIcon class="w-6 h-6 text-gray-500"/>
					</template>
					<div id="filter-wrapper" class="col grid gap-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-5">
						<FormField
                            v-model="query"
							:value="query"
                            name="query"
                            type="text"
							placeholder="Zoeken..."
							:clearable="true"
							:full-height="true"
							classes="block w-full h-full px-3 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed text-black placeholder-gray-400 bg-white border-gray-300 focus:border-blue-500"
                        />
						<MultiSelect
							id="theme-selector"
							v-model="themesSelected"
							:options="themes"
							optionLabel="name"
							optionValue="id"
							placeholder="Thema..."
							filterPlaceholder="Zoeken..."
						/>
						<MultiSelect
							id="category-selector"
							v-model="categoriesSelected"
							:options="categories"
							optionLabel="name"
							optionValue="id"
							placeholder="Categorie..."
							filterPlaceholder="Zoeken..."
						/>
						<FormAutocomplete
							ref="geoSearchRef"
							:items="geoSuggestions"
							:isAsync="true"
							@change="getGeoSuggestions"
							@input="getCoordinates"
							placeholder="Plaatsnaam"
						/>
						<FormSlider
							v-model="distance"
							thumbColor="var(--wkid-blue)"
							progressColor="var(--wkid-blue)"
							unit="km"
							:min="10"
							:max="150"
							:delay="400"
							:disabled="!coordinatesPresent"
						/>
						<div class="flex items-center space-x-3">
							<ToggleSwitch
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
                            v-if="!isGeladen && !appending"
                        >
							<div v-for="i in skeletonArray"
								class="rounded-lg shadow-md overflow-hidden animate-pulse">
								<div class="h-48 row-span-1 bg-gray-200"></div>
								<div class="flex flex-col col-span-2 p-3 justify-between flex-1 bg-white">
									<div class="relative h-6 mb-3 w-full inline-block bg-gray-200 rounded"></div>
									<div class="relative h-3 mb-1 w-full inline-block bg-gray-200 rounded"></div>
									<div class="relative h-3 mb-1 w-full inline-block bg-gray-200 rounded"></div>
									<div class="relative h-6 w-20 inline-block bg-gray-200 rounded mt-3"></div>
								</div>
							</div>
                        </div>
                        <div
                            v-else-if="heeftActies"
                            class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
							:class="{'xl:grid-cols-2 lg:grid-cols-2': narrower}"
						>
                            <Actie
                                v-for="actie in actiesFormatted"
                                :actie="actie"
                            />
                        </div>
						<div v-else-if="isGeladen" class="flex flex-col justify-center items-center py-8 text-gray-400">
							<h3>{{__('general.no_results')}}</h3>
							<div v-if="filterCount" class="flex flex-col items-center">
								<p>{{ __('general.no_results_suggestion_too_many_filters') }}</p>
								<button v-on:click="resetFilters" class="gray uppercase mt-2">
									{{ __('general.clear_filters') }}
								</button>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
		<!-- see more button -->
		<div v-if="enableShowMore && heeftActies && total > perPage && currentPage !== lastPage && !appending" class="flex justify-center">
			<button @click="currentPage++; appending=true; getActies()" class="btn secondary">{{__('general.load_more')}}</button>
		</div>
		<div v-else-if="appending" class="flex justify-center">
			<div class="custom-loader dark large"></div>
		</div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, watch, computed, ref } from "vue"
import FilterIcon from "&/clarity-filter-solid.svg"
import { calcDistance } from "../../helpers/geoHelper"
import debounce from "lodash/debounce"
import _ from 'lodash'
import axios from "axios";
const __ = str => _.get(window.i18n, str)

const props = defineProps({
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
	enableShowMore: {
		type: Boolean,
		default: true,
	},
	skeletons: {
		type: Number,
		default: 10,
	},
	limit: {
		type: Number,
		default: null,
	}
})

const acties = ref([])
const themesSelected = ref(props.themes.filter(t => props.themesSelectedIds.includes(t.id)).map(t => t.id))
const categoriesSelected = ref(props.categories.filter(c => props.categoriesSelectedIds.includes(c.id)).map(c => c.id))
const query = ref("")
const coordinates = ref("")
const distance = ref(100)
const geoSuggestions = ref([])
const showPast = ref(false)
const isGeladen = ref(false)
const appending = ref(false)
const heeftFout = ref(false)
const currentPage = ref(null)
const lastPage = ref(null)
const perPage = ref(null)
const total = ref(null)
const geoSearchRef = ref(null)

const skeletonArray = computed(() => {
	return [...Array(props.skeletons).keys()]
})

const heeftActies = computed(() => {
	return (acties.value.length > 0)
})

const actiesFormatted = computed(() => {
	acties.value.forEach((actie) => {
		actie.body = actie.body.replace(/(<([^>]+)>)/gi, "")
		if (actie._geoloc && coordinates.value !== "") {
			let coordinatesArray = coordinates.value.split(",")
			// calculate distance to actie in km
			actie.distance = calcDistance(actie._geoloc.lat, actie._geoloc.lng,
				coordinatesArray[0], coordinatesArray[1]).toFixed(1)
		} else {
			actie.distance = null
		}
		return actie
	})
	return acties.value
})

const coordinatesPresent = computed(() => {
	return coordinates.value !== ""
})

const filterCount = computed(() => {
	var filters = [query.value, themesSelected.value, categoriesSelected.value, coordinates.value, showPast.value]
	return filters.filter(f => (!!f && !(f.length === 0))).length
})

watch(query, () => {
	getActies()
})

watch(themesSelected, () => {
	getActies()
})

watch(categoriesSelected, () => {
	getActies()
})

watch(distance, () => {
	getActies()
})

watch(showPast, () => {
	getActies()
})

watch(coordinates, () => {
	getActies()
})

onMounted(() => {
	getActies()
})

const getActies = debounce(() => {
	isGeladen.value = false
	heeftFout.value = false
	axios.get(props.routes["acties.search"].uri, {
		params: {
			q: query.value,
			themes: themesSelected.value ? themesSelected.value.map(t => t.id) : props.themeIds,
			categories: categoriesSelected.value,
			coordinates: coordinates.value,
			distance: distance.value,
			show_past: showPast.value,
			page: currentPage.value,
			organizer: props.organizerId,
		}
	}).then((response) => {
		if (appending.value) {
			acties.value = acties.value.concat(processActiesArray(response.data.acties.data))
		} else {
			acties.value = processActiesArray(response.data.acties.data)
		}
		currentPage.value = response.data.acties.current_page
		lastPage.value = response.data.acties.last_page
		perPage.value = response.data.acties.per_page
		total.value = response.data.acties.total
	}).catch((error) => {
		heeftFout.value = true
	}).finally(() => {
		isGeladen.value = true
		appending.value = false
	})
}, 500)

const processActiesArray = (acties) => {
	return acties.filter((a) => !props.excludeIds.includes(a.id)).slice(0, props.limit ?? acties.length)
}

const getGeoSuggestions = async (geoQuery) => {
	axios.get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/suggest", {
		params: {
			q: geoQuery,
			rows: 5,
			fl: "id,weergavenaam",
			fq: "type:woonplaats",
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
	isGeladen.value = false
	if (obj !== "") {
		axios.get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/lookup", {
			params: {
				id: obj.id,
				fl: 'centroide_ll',
			}
		}).then((data) => {
			let pointString = data.data.response.docs[0].centroide_ll
			coordinates.value = pointString.slice(6,pointString.length-1).split(" ").reverse().join(",")
		})
	} else {
		coordinates.value = ""
	}
}

const resetFilters = () => {
	themesSelected.value = []
	categoriesSelected.value = []
	query.value = ""
	geoSearchRef.value.resetResult()
	showPast.value = false
}
</script>

