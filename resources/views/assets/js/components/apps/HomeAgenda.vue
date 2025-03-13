<template>
	<div>
		<div class="row mx-auto max-w-6xl px-3">
			<div class="col" style="width: 100%">
				<div class="relative mx-auto w-full">
					<div class="relative mx-auto max-w-7xl">
						<div v-if="!isGeladen">
							<div class="grid gap-5 mx-auto mt-12 md:grid-cols-2">
								<div v-for="i in Array(2).keys()"
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
							<div class="grid gap-5 mb-12 mx-auto mt-12 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
								<div v-for="i in Array(3).keys()" :key="i"
									class="rounded-lg shadow-md overflow-hidden animate-pulse grid grid-cols-3">
									<div class="flex-shrink-0 h-full col-span-1 bg-gray-200"></div>
									<div class="flex flex-col col-span-2 p-3 justify-between flex-1 bg-white">
										<div class="relative h-6 mb-3 w-full inline-block bg-gray-200 rounded"></div>
										<div class="relative h-3 mb-1 w-full inline-block bg-gray-200 rounded"></div>
										<div class="relative h-3 mb-1 w-full inline-block bg-gray-200 rounded"></div>
										<div class="relative h-6 w-20 inline-block bg-gray-200 rounded mt-3"></div>
									</div>
								</div>
							</div>
						</div>
						<div v-else-if="heeftActies">
							<div class="grid gap-5 mx-auto mt-12 md:grid-cols-2">
								<Actie v-for="actie in actiesFormatted.slice(0, 2)" :key="actie.id" :actie="actie" />
							</div>
							<div class="grid gap-5 mx-auto mt-12 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
								<ActieSmall v-for="actie in actiesFormatted.slice(2, 8)" :key="actie.id"
									:actie="actie" />
							</div>
							<div class="flex items-center justify-center my-12">
								<a href="/acties">
									<button class="primary flex items-center hover:translate-x-[0.250rem]" data-umami-event="View all actions button on homepage">
										<p class="text-lg">{{ __('acties.view_all_actions') }}</p>
										<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
											xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 ml-1"
											style="transform: rotate(180deg);">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
										</svg>
									</button>
								</a>
							</div>
						</div>
						<div v-else-if="isGeladen" class="flex justify-center items-center py-8">
							<div class="text-gray-400">
								<h3>{{ __('general.no_results') }}</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, inject } from 'vue'
import debounce from 'lodash/debounce'
import axios from 'axios'
const __ = inject('translate')

const props = defineProps({
	routes: {
		type: Object,
		required: true
	}
});

const acties = ref([]);
const isGeladen = ref(false);
const heeftFout = ref(false);
const heeftActies = ref(false);

const getActies = debounce((page = 1) => {
	isGeladen.value = false;
	heeftFout.value = false;
	axios.get(props.routes["acties.search"].uri, {
		params: {
			show_past: false,
			limit: 5
		}
	})
	.then(response => {
		acties.value = response.data.acties;
	})
	.catch(error => {
		heeftFout.value = true;
		console.error(error);
	})
	.finally(() => {
		isGeladen.value = true;
		if (acties.value.length > 0) heeftActies.value = true;
	});
}, 300);

const actiesFormatted = computed(() => {
	return acties.value.map(actie => {
		actie.body = actie.body.replace(/(<([^>]+)>)/gi, "");
		return actie;
	});
});

onMounted(() => {
	getActies();
});
</script>
