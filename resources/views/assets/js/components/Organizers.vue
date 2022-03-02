<template>
    <div>
        <div class="row mx-auto max-w-6xl">
            <div id="filter-container" class="row my-3">
                <h3 class="mt-8 mb-3 text-sm text-gray-900">Zoek & Filter</h3>
                <div id="filter-wrapper" class="col grid gap-3 grid-cols-2">
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
                </div>
            </div>
        </div>
        <div class="row mx-auto max-w-6xl mb-8" >
            <div class="col" style="width: 100%">
                <div class="relative mx-auto w-full">
                    <div class="relative mx-auto max-w-7xl">
                        <div v-if="!isGeladen">
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
            @page-changed="getOrganizers"
        />
    </div>
</template>

<script>
import Pagination from "./Pagination.vue"
export default {
	name: "Organizations",
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
	},
	data() {
		return {
			organizers: [],
			themesSelected: "",
			query: "",
			isGeladen: false,
			heeftFout: false,
			currentPage: null,
			perPage: null,
			total: null,
			base_link: null,
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
				return organizer
			})
			return this.organizers
		},
		organizerBaseRoute() {
			return this.routes["organizers.organizer"].uri.split("{")[0]
		}
	},
	watch: {
		query: function() {
			this.getOrganizers()
		},
		themesSelected: function() {
			this.getOrganizers()
		}
	},
	mounted() {
		this.getOrganizers()
	},
	methods: {
		getOrganizers: _.debounce(async function getOrganizers(page = 1) {
			this.isGeladen = false
			this.heeftFout = false
			axios.get(this.routes["organizers.search"].uri, {
				params: {
					q: this.query,
					themes: this.themesSelected,
					page: page,
					organizer: this.organizerId,
				}
			}).then((response) => {
				this.organizers = response.data.organizers.data
				this.currentPage = response.data.organizers.current_page
				this.perPage = response.data.organizers.per_page
				this.total = response.data.organizers.total
				this.base_link = response.data.organizers.first_page_url
			}).catch((error) => {
				this.heeftFout = true
			}).finally(() => {
				this.isGeladen = true
			})
		}, 500),
		processQuery: _.debounce(function(input) {
			this.query = input
		}, 500),
	}
}
</script>

