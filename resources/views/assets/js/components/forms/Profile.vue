<template>
    <form :action="routes.profile_put" method="POST" enctype="multipart/form-data">
        <slot name="csrf"/>
		<div class="relative flex flex-col p-6">
			<div v-if="Object.keys(errors).length > 0" class="p-3 mb-3 text-sm rounded-md failure">
				<span
					v-for="error in Object.keys(errors)"
					:key="error"
				>
					{{ errors[error][0] }}
				</span>
			</div>
			<div class="flex justify-start w-32 h-32 mb-8 lg:m-b0">
				<FormImage
					:previous-image="previousImage"
					field-name="avatar"
					stencil-type="circle"
					:stencil-props="{
						minAspectRatio: 1/1,
						maxAspectRatio: 1/1
					}"
					:default-char="defaultChar"
					:header="imageUploadHeader"
					:delete-route="routes.delete_avatar"
				/>
			</div>
			<div class="w-full lg:w-9/12 xl:w-4/5">
				<!-- Name -->
				<FormField
					v-model="user.name"
					label="Naam"
					name="name"
					type="text"
					:rules="{max: 50}"
					required
				/>

				<!-- Email -->
				<FormField
					v-model="user.email"
					label="E-mailadres"
					name="email"
					type="email"
					:rules="{max: 70, email: true}"
					autocomplete="email"
					required
					disabled
				/>

				<div class="flex justify-end w-full">
					<button class="flex self-end justify-center w-auto px-4 py-2 mt-5 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700" dusk="update-profile-button">
						{{ __("general.save") }}
					</button>
				</div>
			</div>
		</div>
	</form>
</template>

<script setup lang="ts">

import { computed } from 'vue';
import _ from 'lodash';
const __ = str => _.get(window.i18n, str)

const props = defineProps({
	routes: {
		type: Object,
		required: true,
	},
	user: {
		type: Object,
		required: true,
	},
	errors: {
		type: Object,
		default: () => {}
	},
})

const imageUploadHeader = computed(() => __("general.position_and_resize_photo"))
const previousImage = computed(() => props.user.linked_image ? props.user.linked_image.url + '?' + new Date() : '')
const defaultChar = computed(() => props.user.name.slice(0, 1).toUpperCase())

</script>
<style scoped>
    .failure {
        color: var(--wkid-message-error-dark);
        background: var(--wkid-message-error-light);
    }
</style>

