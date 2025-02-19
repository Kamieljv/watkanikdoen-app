<template>
    <div>
        <div class="row mx-auto max-w-6xl">
            <div id="filter-container" class="row my-3">
                <h3 class="mt-8 mb-3 text-sm text-gray-900">Zoek & Filter</h3>
                <div id="filter-wrapper" class="col grid gap-3" :class="{'grid-cols-2': themes.length > 0}">
					<FormField
						v-model="query"
						:value="query"
						name="query"
						type="text"
						placeholder="Zoeken..."
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
						optionValue="id"
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
                        <div v-if="!isGeladen && !appending">
                        	<div v-for="i in skeletonArray"
                                :key="i"
								class="animate-pulse flex h-full p-3 justify-between border border-gray-200 mb-1 rounded-lg shadow-md"
							>
								<div class="flex space-x-3 w-full justify-start items-center">
									<div class="w-10 h-10 rounded-full bg-gray-200"></div>
									<div class="relative h-6 w-1/3 inline-block bg-gray-200 rounded"></div>
								</div>
							</div>
                        </div>
                        <div v-else-if="heeftOrganizers" >
                            <Organizer
                                v-for="organizer in organizersFormatted"
                                :key="organizer.id"
                                :organizer="organizer"
								:route="organizerBaseRoute + organizer.slug"
								:show-themes="showThemes"
								:mode="mode"
								:selected-initial="organizer.selected"
								@update:modelValue="updateOrganizersSelected($event, organizer)"
                            >
								{{organizer.selected}}
							</Organizer>
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
		<div v-if="enableShowMore && heeftOrganizers && total > perPage && currentPage !== lastPage && !appending" class="flex justify-center">
			<button @click="currentPage++; appending=true; getOrganizers()" class="btn secondary">{{__('general.load_more')}}</button>
		</div>
		<div v-else-if="appending" class="flex justify-center">
			<div class="custom-loader dark large"></div>
		</div>
    </div>
</template>

<script setup lang="ts">
	import { ref, computed, watch, onMounted, inject } from 'vue'
	import axios from 'axios'
	import debounce from 'lodash/debounce'
	const emit = defineEmits(['update:modelValue'])
	const __ = inject('translate')


	const props = defineProps({
		routes: {
			type: Object,
			required: true,
		},
		themes: {
			type: Array,
			default: () => [],
		},
		showThemes: {
			type: Boolean, 
			default: true,
		},
		enableShowMore: {
			type: Boolean, 
			default: true
		},
		max: {
			type: Number,
			default: null,
		},
		mode: {
			type: String,
			default: 'list',
		},
		organizersSelected: {
			type: Array,
			default: () => [],
		}
	})
	
	const query = ref("")
	const organizers = ref([])
	const themesSelected = ref([])
	const organizersSel = ref(props.organizersSelected)
	const isGeladen = ref(false)
	const appending = ref(false)
	const currentPage = ref(null)
	const lastPage = ref(null)
	const perPage = ref(null)
	const total = ref(null)
	const skeletonArray = ref([...Array(10).keys()])

	const heeftOrganizers = computed(() => {
		return (organizers.value.length > 0)
	})

	const organizersFormatted = computed(() => {
		organizers.value.forEach((organizer) => {
			organizer.description = organizer.description ? organizer.description.replace(/(<([^>]+)>)/gi, "") : null
			organizer.selected = isSelected(organizer)
			return organizer
		})
		return organizers.value
	})
	const organizerBaseRoute = computed(() => {
		return props.routes["organizers.organizer"].uri.split("{")[0]
	})

	const filterCount = computed(() => {
		var filters = [query.value, themesSelected.value]
		return filters.filter(f => (!!f && !(f.length === 0))).length
	})

	watch(query, () => {
		getOrganizers()
	})

	watch(themesSelected, () => {
		getOrganizers()
	})

	watch(() => props.organizersSelected, () => {
		organizersSel.value = props.organizersSelected
	})

	onMounted(() => {
		getOrganizers()
	})
	
	const getOrganizers = debounce(() => {
		isGeladen.value = false
		axios.get(props.routes["organizers.search"].uri, {
			params: {
				q: query.value,
				themes: themesSelected.value ? themesSelected.value : null,
				page: currentPage.value,
				limit: props.max ?? null
			}
		}).then((response) => {
			if (props.max) {
				organizers.value = response.data.organizers
				return
			}
			else if (appending.value) {
				organizers.value = organizers.value.concat(response.data.organizers.data)
			} else {
				organizers.value = response.data.organizers.data
			}
			currentPage.value = response.data.organizers.current_page
			lastPage.value = response.data.organizers.last_page
			perPage.value = response.data.organizers.per_page
			total.value = response.data.organizers.total
		}).finally(() => {
			isGeladen.value = true
			appending.value = false
		})
	}, 500)

	const updateOrganizersSelected = (value, organizer) => {
		if (value === true) {
			organizersSel.value.push(organizer)
		} else {
			organizersSel.value = organizersSel.value.filter((v) => {
				if (!('id' in organizer)) {
					return true
				}
				return v.id !== organizer.id
			})
		}
		emit('update:modelValue', organizersSel.value)
	}
	
	const isSelected = (organizer) => {
		return !!organizersSel.value.find((v: object) => {
			if (!('id' in v)) {
				return false
			}
			return v.id === organizer.id
		})
	}

	const resetFilters = () => {
		themesSelected.value = []
		query.value = ""
	}
</script>

