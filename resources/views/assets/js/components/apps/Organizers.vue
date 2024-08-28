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
                            <organizer
                                v-for="organizer in organizersFormatted"
                                :key="organizer.id"
                                :organizer="organizer"
								:route="organizerBaseRoute + organizer.slug"
								:show-themes="showThemes"
								:mode="mode"
								:selected-initial="organizer.selected"
								@input="updateOrganizersSelected($event, organizer)"
                            >{{organizer.selected}}</organizer>
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
		<div v-if="enableShowMore && heeftOrganizers && total > perPage && currentPage !== lastPage && !appending" class="flex justify-center">
			<button @click="currentPage++; appending=true; getOrganizers()" class="btn secondary">{{__('general.load_more')}}</button>
		</div>
		<div v-else-if="appending" class="flex justify-center">
			<div class="custom-loader dark large"></div>
		</div>
    </div>
</template>

<script>
import Pagination from "../partials/Pagination.vue"
export default {
	name: "Organizers",
	components: {Pagination},
	props: {
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
	},
	data() {
		return {
			organizers: [],
			themesSelected: "",
			organizersSel: this.organizersSelected,
			query: "",
			isGeladen: false,
			appending: false,
			heeftFout: false,
			currentPage: null,
			lastPage: null,
			perPage: null,
			total: null,
		}
	},
	computed: {
		skeletonArray() {
			return [...Array(10).keys()]
		},
		heeftOrganizers() {
			return (this.organizers.length > 0)
		},
		organizersFormatted() {
			this.organizers.forEach((organizer) => {
				organizer.description = organizer.description ? organizer.description.replace(/(<([^>]+)>)/gi, "") : null
				organizer.selected = this.isSelected(organizer)
				return organizer
			})
			return this.organizers
		},
		organizerBaseRoute() {
			return this.routes["organizers.organizer"].uri.split("{")[0]
		},
	},
	watch: {
		query: function() {
			this.getOrganizers()
		},
		themesSelected: function() {
			this.getOrganizers()
		},
		organizersSelected: function() {
			this.organizersSel = this.organizersSelected
		}
	},
	mounted() {
		this.getOrganizers()
	},
	methods: {
		getOrganizers: _.debounce(async function getOrganizers() {
			this.isGeladen = false
			this.heeftFout = false
			axios.get(this.routes["organizers.search"].uri, {
				params: {
					q: this.query,
					themes: this.themesSelected,
					page: this.currentPage,
					organizer: this.organizerId,
					limit: this.max ?? null
				}
			}).then((response) => {
				if ('per_page' in response.data.organizers) {
					if (this.appending) {
						this.organizers = this.organizers.concat(response.data.organizers.data)
					} else {
						this.organizers = response.data.organizers.data
					}
					this.currentPage = response.data.organizers.current_page
					this.lastPage = response.data.organizers.last_page
					this.perPage = response.data.organizers.per_page
					this.total = response.data.organizers.total
				} else {
					this.organizers = response.data.organizers
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
		updateOrganizersSelected: function(value, organizer) {
			if (value === true) {
				this.organizersSel.push(organizer)
			} else {
				this.organizersSel = this.organizersSel.filter((v) => {
					if (!('id' in organizer)) {
						return true
					}
					return v.id !== organizer.id
				})
			}
			this.$emit('input', this.organizersSel)
		},
		isSelected: function(organizer) {
			return !!this.organizersSel.find((v) => {
				if (!('id' in v)) {
					return false
				}
				return v.id === organizer.id
			})
		},
	}
}
</script>

