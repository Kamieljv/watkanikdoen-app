<template>
    <div>
        <div class="row mx-auto max-w-6xl px-3 mb-8" >
            <div class="col" style="width: 100%">
                <div class="relative mx-auto w-full">
                    <div class="relative mx-auto max-w-7xl">
                        <div
                            class="grid gap-5 mx-auto mt-12 md:grid-cols-2"
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
						>
							<div class="grid gap-5 mx-auto mt-12 md:grid-cols-2">
								<actie
									v-for="actie in actiesFormatted.slice(0, 2)"
									:key="actie.id"
									:actie="actie"
								/>
							</div>
							<div class="grid gap-5 mx-auto mt-12 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
								<actie-small
									v-for="actie in actiesFormatted.slice(2, 5)"
									:key="actie.id"
									:actie="actie"
								/>
							</div>
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
    </div>
</template>

<script>
export default {
	name: "HomeAgenda",
	props: {
		routes: {
			type: Object,
			required: true,
		},
		narrower: {
			type: Boolean,
			default: false,
		},
	},
	data() {
		return {
			acties: [],
			isGeladen: false,
			heeftFout: false,
		}
	},
	computed: {
		skeletonArray() {
			var n = this.narrower ? 6 : 10
			return [...Array(n).keys()]
		},
		heeftActies() {
			return (this.acties.length > 0)
		},
		actiesFormatted() {
			this.acties.forEach((actie) => {
				actie.body = actie.body.replace(/(<([^>]+)>)/gi, "")
				return actie
			})
			return this.acties
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
					show_past: false,
					limit: 5
				}
			}).then((response) => {
				this.acties = response.data.acties
			}).catch((error) => {
				this.heeftFout = true
			}).finally(() => {
				this.isGeladen = true
			})
		}, 500)
	}
}
</script>

