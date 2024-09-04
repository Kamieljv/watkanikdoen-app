<template>
    <div>
        <div v-if="filterable" class="row mx-auto max-w-6xl">
            <div id="filter-container" class="row my-3">
                <h3 class="mt-8 mb-3 text-sm text-gray-900">Zoek & Filter</h3>
                <div id="filter-wrapper" class="col grid gap-3" :class="{'grid-cols-2': themes.length > 0}">
					<FormField
						v-model="query"
						:value="query"
						name="query"
						type="text"
						placeholder="Zoeken..."
						@input="processQuery"
						:clearable="true"
						autofocus
						classes="block w-full h-full px-3 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed text-black placeholder-gray-400 bg-white border-gray-300 focus:border-blue-500"
					/>
                    <t-rich-select
						v-if="themes.length > 0"
                        id="theme-selector"
                        :options="themes"
                        textAttribute="name"
                        v-model="themesSelected"
                        :multiple="true"
                        :closeOnSelect="false"
                        placeholder="Thema..."
						searchBoxPlaceholder="Zoeken..."
						:minimumResultsForSearch="5"
						noResultsText="Geen resultaten"
					/>
                </div>
            </div>
        </div>
        <div class="row mx-auto max-w-6xl mb-8" >
            <div class="col" style="width: 100%">
                <div class="relative mx-auto w-full">
                    <div class="relative mx-auto max-w-7xl">
                        <div v-if="!isGeladen && !appending" class="grid grid-auto gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3">
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
							</t-card>
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
								<p>{{ __('general.no_results_suggestion') }}</p>
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
		<t-modal
			v-if="currentReferentie"
			v-model="modalOpen"
			variant="card"
		>
			<template v-slot:header>
				<img v-if="currentReferentie.linked_image" class="object-cover w-full h-[150px]" :src="currentReferentie.linked_image.url" alt="">
                <div v-else class="h-[150px] bg-gray-300 text-gray-400 flex items-center justify-center">
                    <svg-vue icon="logo-icon" style="fill: currentColor; height: 80px;"></svg-vue>
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
				<div v-if="currentReferentie.referentie_types.length > 1" class="mt-2">
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
					{{  }}
				</div>
			</div>
			<template v-slot:footer>
				<div class="flex justify-end">
					<a :href="currentReferentie.url">
						<button class="btn pink items-center" type="button">
							<svg-vue icon="antdesign-link-o" class="w-4 h-4 mr-1" fill="currentColor" />
							{{ simplifyUrl(currentReferentie.url) }}
						</button>
					</a>
				</div>
			</template>
		</t-modal>
    </div>
</template>

<script>
export default {
	name: "Referenties",
	props: {
		referentieTypeId: {
			type: Number,
			required: true,
		},
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
	},
	data() {
		return {
			referenties: [],
			currentReferentie: null,
			themesSelected: [],
			query: "",
			isGeladen: false,
			heeftFout: false,
			currentPage: null,
			lastPage: null,
			perPage: null,
			total: null,
			appending: false,
			modalOpen: false,
		}
	},
	computed: {
		skeletonArray() {
			return [...Array(this.max ?? 9).keys()]
		},
		heeftReferenties() {
			return (this.referenties.length > 0)
		},
		referentiesFormatted() {
			this.referenties.forEach((referentie) => {
				referentie.description = referentie.description ? referentie.description.replace(/(<([^>]+)>)/gi, "") : null
				return referentie
			})
			return this.referenties
		},
		filterCount() {
			var filters = [this.query, this.themesSelected]
			return filters.filter(f => (!!f && !(f.length === 0))).length
		},
	},
	watch: {
		query: function() {
			this.getReferenties()
		},
		themesSelected: function() {
			this.getReferenties()
		},
	},
	mounted() {
		this.themesSelected = this.themes.filter(t => this.themesSelectedIds.includes(t.id)).map(t => t.id);
		this.getReferenties();
	},
	methods: {
		getReferenties: _.debounce(async function getReferenties() {
			this.isGeladen = false
			this.heeftFout = false
			axios.get(this.routes["referenties.search"].uri, {
				params: {
					referentieTypeId: this.referentieTypeId,
					q: this.query,
					themes: this.themesSelected,
					page: this.currentPage,
					limit: this.max ?? null
				}
			}).then((response) => {
				if ('per_page' in response.data.referenties) {
					if (this.appending) {
						this.referenties = this.referenties.concat(response.data.referenties.data)
					} else {
						this.referenties = response.data.referenties.data
					}
					this.currentPage = response.data.referenties.current_page
					this.lastPage = response.data.referenties.last_page
					this.perPage = response.data.referenties.per_page
					this.total = response.data.referenties.total
				} else {
					this.referenties = response.data.referenties
				}
			}).catch((error) => {
				this.heeftFout = true
			}).finally(() => {
				this.isGeladen = true
				this.appending = false
			})
		}, 500),
		processQuery: _.debounce(function(input) {
			this.query = input
		}, 500),
		openReferentieModal(e, referentie) {
			this.currentReferentie = referentie
			console.log(referentie)
			this.modalOpen = true
		},
		simplifyUrl(url) {
			// remove http(s):// and trailing slash
			return url.replace(/(^\w+:|^)\/\//, "").replace(/\/$/, "")
		},
		resetFilters() {
			this.themesSelected = []
			this.query = ""
		}
	}
}
</script>
<style scoped>
	a.tag-link {
		color: inherit;
		text-decoration: none !important
	}
</style>

