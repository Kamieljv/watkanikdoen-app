<template>
    <form :action="routes.profile_put" method="POST" enctype="multipart/form-data">
        <slot name="csrf"/>
		<div class="relative flex flex-col p-6">
			<div class="flex justify-start w-full mb-8 w-full h-32 lg:m-b0">
				<form-image
					:previous-image="previousImage"
					field-name="avatar"
					viewport-type="circle"
					:default-char="defaultChar"
					:header="imageUploadHeader"
					:ratio="1"
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

<script>

import { ValidationProvider } from 'vee-validate';
import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "Profile",
    components: {
        ValidationProvider,
    },
    mixins: [
        caseHelper,
    ],
    props: {
        routes: {
            type: Object,
            required: true,
        },
        user: {
            type: Object,
            required: true,
        }
    },
    data() {
		return {
        }
	},
    computed: {
        imageUploadHeader() {
            return this.__("general.position_and_resize_photo")
        },
        previousImage() {
            return this.user.linked_image ? user.linked_image.url + '?' + new Date() : ''
        },
        defaultChar() {
            return this.user.name.slice(0, 1).toUpperCase()
        }
    },
}
</script>

