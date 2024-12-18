<template>
    <div>
        <div v-if="filterable" class="row mx-auto max-w-6xl">
            <div id="filter-container" class="row my-3">
                <h3 class="mt-8 mb-3 text-sm text-gray-900">Zoek & Filter</h3>
                <div id="filter-wrapper" class="col grid gap-3" :class="{'grid-cols-2': themes.length > 0}">
					<FormField
						v-model="query"
						name="query"
						type="text"
						placeholder="Zoeken..."
						@input="processQuery"
						:clearable="true"
						:full-height="true"
						autofocus
						classes="block w-full h-full px-3 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed text-black placeholder-gray-400 bg-white border-gray-300 focus:border-blue-500"
					/>
                    <MultiSelect
						v-if="themes.length > 0"
						id="theme-selector"
						v-model="themesSelected"
						:options="themes"
						optionLabel="name"
						placeholder="Thema..."
						filterPlaceholder="Zoeken..."
					/>
                </div>
            </div>
        </div>
        <div class="row mx-auto max-w-6xl mb-8" >
            <div class="col" style="width: 100%">
                <div class="relative mx-auto w-full">
                    <div class="relative mx-auto max-w-7xl">
                        <div v-if="!isGeladen && !appending" class="grid grid-auto gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3">
							<div v-for="i in skeletonArray"
                                :key="i"
								class="animate-pulse flex flex-col h-full justify-between border border-gray-200 mb-1 rounded-lg shadow-md"
							>
								<div class="h-48 row-span-1 bg-gray-200"></div>
								<div class="p-3">
									<div class="relative h-6 w-full inline-block bg-gray-200 rounded"></div>
									<div class="relative h-3 w-full inline-block bg-gray-200 rounded"></div>
								</div>
							</div>
                        </div>
                        <div v-else-if="heeftReferenties" class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3">
                            <Referentie
                                v-for="referentie in referentiesFormatted"
                                :key="referentie.id"
                                :referentie="referentie"
								@click.native="openReferentieModal($event, referentie)"
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
		<div v-if="enableShowMore && heeftReferenties && total > perPage && currentPage !== lastPage && !appending" class="flex justify-center">
			<button @click="currentPage++; appending=true; getReferenties()" class="btn secondary">{{__('general.load_more')}}</button>
		</div>
		<div v-else-if="appending" class="flex justify-center">
			<div class="custom-loader dark large"></div>
		</div>

		<!-- Referentie Modal -->
		<Dialog
			modal
			v-if="currentReferentie"
			class="w-full sm:w-1/2"
			v-model:visible="modalOpen"
			:draggable="false"
			pt:mask:class="dialog-mask"
			pt:header:class="flex items-center justify-between shrink-0 rounded-tl-lg rounded-tr-lg text-surface-700 dark:text-surface-0/80 border border-b-0 border-surface-200 dark:border-surface-700"
			pt:headeractions:class="flex items-center absolute top-0 right-0 m-3"
			pt:content:class="p-3 text-surface-700 dark:text-surface-0/80 border border-t-0 border-b-0 border-surface-200 dark:border-surface-700 overflow-y-auto"
			pt:footer:class="flex items-center justify-end shrink-0 text-right gap-2 px-3 pb-3 border-t-0 rounded-b-lg bg-surface-0 dark:bg-surface-900 text-surface-700 dark:text-surface-0/80 border border-t-0 border-b-0 border-surface-200 dark:border-surface-700"
		>
			<template v-slot:header>
				<img v-if="currentReferentie.linked_image" class="object-cover w-full h-[150px]" :src="currentReferentie.linked_image.url" alt="">
                <div v-else class="h-[150px] md:h-[250px] w-full bg-gray-300 text-gray-400 flex items-center justify-center">
                    <LogoIcon style="fill: currentColor; height: 80px;" />
                </div>
				<ul class="themes-container flex flex-wrap m-3 absolute top-0 w-4/5">
                    <li
                        v-for="theme in currentReferentie.themes"
                        :key="theme.id"
                        class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
                        :style="{backgroundColor: theme.color}"
                    >
                        <span class="text-white" rel="theme">
                            {{ theme.name }}
                        </span>
                    </li>
                </ul>
			</template>
			<div class="title-body-container overflow-hidden relative">
				<h3 class="line-clamp-2 uppercase text-xl font-semibold leading-7 text-gray-900">
					{{ currentReferentie.title }}
				</h3>
				<p class="my-2 text-sm text-gray-500" v-html="currentReferentie.description"></p>
				<div v-if="currentReferentie.referentie_types.length > 1" class="mt-4">
					<p class="text-sm text-gray-500 font-semibold">Wat kun je hier nog meer doen?</p>
					<ul class="flex flex-wrap my-2">
						<li
							v-for="refType in currentReferentie.referentie_types"
							:key="refType.id"
							class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-700 rounded"
						>
							<a :href="refType.link" class="tag-link cursor-pointer">
								<span class="text-white" rel="theme">
									{{ refType.title }}
								</span>
							</a>
						</li>
                	</ul>
				</div>
			</div>
			<template v-slot:footer>
				<div class="flex justify-end">
					<a :href="currentReferentie.url">
						<button class="btn text-xl pink items-center" type="button">
							<LinkIcon class="w-4 h-4 mr-1" fill="currentColor" />
							{{ __('general.go_to')}}&nbsp;
							<span class="font-extrabold">{{ simplifyUrl(currentReferentie.url) }}</span>
						</button>
					</a>
				</div>
			</template>
		</Dialog>
    </div>
</template>

<script setup lang="ts">

import LogoIcon from '&/logo-icon.svg'
import LinkIcon from '&/antdesign-link-o.svg'
import { ref, computed, onMounted, watch, inject } from 'vue'
import axios from 'axios'
import debounce from "lodash/debounce"
const __ = inject('translate')

const props = defineProps({
	referentieTypeId: {
		type: Number,
		default: null,
	},
	routes: {
		type: Object,
		default: () => {},
	},
	themes: {
		type: Array,
		default: () => [],
	},
	themesSelectedIds: {
		type: Array,
		default: () => [],
	},
	referentiesFixed: {
		type: Array,
		default: () => [],
	},
	enableShowMore: {
		type: Boolean,
		default: true,
	},
	showThemes: {
		type: Boolean, 
		default: true,
	},
	filterable: {
		type: Boolean,
		default: true,
	},
	max: {
		type: Number,
		default: null,
	},
})

const referenties = ref([])
const currentReferentie = ref(null)
const themesSelected = ref(props.themes.filter(t => props.themesSelectedIds.includes(t.id)).map(t => t.id))
const query = ref("")
const isGeladen = ref(false)
const heeftFout = ref(false)
const currentPage = ref(null)
const lastPage = ref(null)
const perPage = ref(null)
const total = ref(null)
const appending = ref(false)
const modalOpen = ref(false)
const skeletonArray = ref([...Array(props.max ?? 9).keys()])

const heeftReferenties = computed(() => referenties.value.length > 0)

const referentiesFormatted = computed(() => {
	referenties.value.forEach((referentie) => {
		referentie.description = referentie.description ? referentie.description.replace(/(<([^>]+)>)/gi, "") : null
		return referentie
	})
	return referenties.value
})

const filterCount = computed(() => {
	const filters = [query.value, themesSelected.value]
	return filters.filter(f => !!f && !(f.length === 0)).length
})

watch(query, () => {
	if (props.referentiesFixed.length === 0) {
		getReferenties()
	}
})

watch(themesSelected, () => {
	if (props.referentiesFixed.length === 0) {
		getReferenties()
	}
})

const getReferenties = debounce(() => {
	isGeladen.value = false
	heeftFout.value = false
	axios.get(props.routes["referenties.search"].uri, {
		params: {
			referentieTypeId: props.referentieTypeId,
			q: query.value,
			themes: themesSelected.value,
			page: currentPage.value,
			limit: props.max ?? null
		}
	}).then((response) => {
		if ('per_page' in response.data.referenties) {
			if (appending.value) {
				referenties.value = referenties.value.concat(response.data.referenties.data)
			} else {
				referenties.value = response.data.referenties.data
			}
			currentPage.value = response.data.referenties.current_page
			lastPage.value = response.data.referenties.last_page
			perPage.value = response.data.referenties.per_page
			total.value = response.data.referenties.total
		} else {
			referenties.value = response.data.referenties
		}
	}).catch((error) => {
		heeftFout.value = true
	}).finally(() => {
		isGeladen.value = true
		appending.value = false
	})
}, 500)

const processQuery = (value) => {
	query.value = value
}

const openReferentieModal = (e, referentie) => {
	currentReferentie.value = referentie
	modalOpen.value = true
}

const simplifyUrl = (url) => {
	return url.replace(/(^\w+:|^)\/\//, "").replace(/\/$/, "")
}

const resetFilters = () => {
	themesSelected.value = []
	query.value = ""
}

onMounted(() => {
	if (props.referentiesFixed.length > 0) {
		referenties.value = props.referentiesFixed
		isGeladen.value = true
	} else {
		getReferenties()
	}
})

// close Dialog when clicking outside
document.addEventListener('click', (e) => {
	// check if clicked element has class dialog-mask
	if (modalOpen.value && e.target.classList.contains('dialog-mask')) {
		modalOpen.value = false
	}
	
})


</script>
<style>
	a.tag-link {
		color: inherit;
		text-decoration: none !important
	}

	.dialog-mask {
		background-color: rgba(0, 0, 0, 0.5);
	}
</style>

