<template>
    <div>
        <div class="row mx-auto max-w-6xl px-3" >
            <div class="col" style="width: 100%">
                <div class="relative mx-auto w-full">
                    <div class="relative mx-auto max-w-7xl">
                        <div
                            v-if="heeftActies"
						>
							<div class="grid gap-5 mx-auto mt-10 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
								<actie-small
									v-for="actie in actiesFormatted"
									:key="actie.id"
									:actie="actie"
									:targetBlank="true"
								/>
							</div>
							<div class="flex items-center justify-center my-12">
								<a href="/acties" target="_blank">
									<button class="primary flex items-center hover:translate-x-[0.250rem]">
										<p class="text-lg">{{__('acties.view_all_actions')}}</p>
										<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 ml-1" style="transform: rotate(180deg);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
									</button>
								</a>
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

<script setup lang="ts">

import { computed, inject } from 'vue';
const __ = inject('translate');

const props = defineProps({
	acties: {
		type: Array,
		required: true,
	},
});

const heeftActies = computed(() => {
	return (props.acties.length > 0)
});

const actiesFormatted = computed(() => {
	props.acties.forEach((actie) => {
		actie.body = actie.body.replace(/(<([^>]+)>)/gi, "")
		return actie
	})
	return props.acties
});

</script>

