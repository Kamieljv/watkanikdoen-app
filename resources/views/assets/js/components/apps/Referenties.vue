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
                        <div v-if="!isGeladen && !appending" class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3">
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
        <!-- see more button -->
		<div v-if="enableShowMore && heeftReferenties && total > perPage && currentPage !== lastPage && !appending" class="flex justify-center">
			<button @click="currentPage++; appending=true; getReferenties()" class="btn secondary">{{__('general.load_more')}}</button>
		</div>
		<div v-else-if="appending" class="flex justify-center">
			<div class="custom-loader dark large"></div>
		</div>
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
			themesSelected: [],
			query: "",
			isGeladen: false,
			heeftFout: false,
			currentPage: null,
			lastPage: null,
			perPage: null,
			total: null,
			appending: false,
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
		}, 500)
	}
}
</script>

