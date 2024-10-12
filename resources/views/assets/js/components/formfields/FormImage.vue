<template>
    <div class="w-full h-full">
		<!-- Form input element -->
        <div class="relative h-32" :class="{'w-32': stencilType === 'circle'}">
			<img v-if="preview" id="preview" :src="preview" class="w-full h-full object-cover" :class="{'rounded-full': stencilType === 'circle', 'rounded-sm': stencilType !== 'circle'}">
			<div v-else :class="{'rounded-full': stencilType === 'circle', 'rounded-sm': stencilType !== 'circle'}" class="flex items-center justify-center text-6xl w-full h-full text-white" :style="{background: defaultColor}">{{ defaultChar }}</div>
			<div class="absolute inset-0 w-full h-full">
				<input v-if="!disabled" v-show="false" type="file" ref="uploadRef" id="upload" @change="imageUploaded">
				<input v-if="!disabled" type="hidden" :value="preview" :name="fieldName">
				<div v-if="!disabled" class="absolute bottom-0 w-full z-10 flex mb-3 space-x-1 items-center justify-center text-white">
					<button v-if="preview" @click="deleteClick" class="flex items-center justify-center cursor-pointer w-10 h-10 bg-black bg-opacity-75 hover:bg-opacity-100 rounded-full">
						<DeleteIcon class="w-6 h-6" fill="currentColor" />
					</button>
					<button @click="uploadImage" class="flex items-center justify-center cursor-pointer w-10 h-10 bg-black bg-opacity-75 hover:bg-opacity-100 rounded-full">
						<CameraIcon class="w-6 h-6" fill="currentColor" />
					</button>
				</div>
			</div>
		</div>
		<!-- Error space -->
		<div class="w-full mt-1 text-red-500">
			{{ error }}
		</div>
		<!-- Edit (Crop/Move/Zoom) Modal -->
		<Dialog
			modal
			:header="header"
			class="w-full sm:w-1/2"
			v-model:visible="uploadOpen"
		>
			<div class="flex justify-center">
				<cropper
					class="cropper"
					ref="cropperRef"
					:src="uploaded"
					:stencil-component="stencilComponent"
					:stencil-props="stencilProps"
					@ready="setReady"
				></cropper>
				<div v-show="isLoading" class="flex justify-center items-center h-20">
					<svg class="animate-spin -ml-1 mr-3 h-8 w-8 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
						<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
						<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
					</svg>
				</div>
			</div>

			<template v-slot:footer>
				<button @click="cancelUpload" class="inline-flex justify-center w-full px-4 py-2 mr-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-transparent border-gray-300 rounded-md shadow-sm hover:text-gray-500 active:text-gray-800 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5" type="button">
					Annuleren
				</button>
				<button @click="crop" class="inline-flex justify-center w-full px-4 py-2 ml-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 sm:text-sm sm:leading-5" id="apply-crop" type="button">
					Toepassen
					<div v-if="isLoading && uploaded" class="custom-loader"></div>
				</button>
			</template>
		</Dialog>
		<!-- Delete Modal -->
		<Dialog
			v-model:visible="deleteOpen"
			class="w-full sm:w-1/2 overflow-hidden"
			header="Weet je zeker dat je de foto wil verwijderen?"
		>
			Als je op "Ja" klikt wordt de foto voor goed verwijderd.
			<template v-slot:footer>
				<button @click="cancelDelete" class="inline-flex justify-center w-full px-4 py-2 mr-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-transparent border-gray-300 rounded-md shadow-sm hover:text-gray-500 active:text-gray-800 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5" type="button">
					Annuleren
				</button>
				<button @click="deleteImage" class="inline-flex justify-center w-full px-4 py-2 ml-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-[color:var(--wkid-red)] hover:bg-[color:var(--wkid-red-dark)] focus:outline-none focus:border-blue-700 sm:text-sm sm:leading-5" type="button">
					Ja, ik weet het zeker
				</button>
			</template>
		</Dialog>
    </div>
</template>

<script setup lang="ts">

import axios from 'axios';
import { computed, onMounted, ref, watch } from 'vue'
import { Cropper, CircleStencil } from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css';
import DeleteIcon from '&/antdesign-delete-o.svg'
import CameraIcon from '&/antdesign-camera-o.svg'
const emit = defineEmits(['update:modelValue'])

const props = defineProps({
	fieldName: {
		type: String,
		required: true,
	},
	deleteRoute: {
		type: String,
		default: "",
	},
	disabled: {
		type: Boolean,
		default: false,
	},
	previousImage: {
		type: String,
		default: "",
	},
	previousBase64: {
		type: String,
		default: "",
	},
	header: {
		type: String,
		default: "Position and Resize photo",
	},
	width: {
		type: Number,
		default: 250,
	},
	stencilProps: {
		type: Object,
		default: () => {},
	},
	stencilType: {
		type: String,
		default: "rectangle",
	},
	defaultChar: {
		type: String,
		default: "?",
	},
	defaultColor: {
		type: String,
		default: "var(--wkid-pink)",
	},
	maxSize: {
		type: Number,
		default: 5000000, // in bytes
	}
})

const uploaded = ref("")
const preview = ref(props.previousImage)
const uploadOpen = ref(false)
const deleteOpen = ref(false)
const isLoading = ref(false)
const error = ref("")
const uploadRef = ref(null)
const cropperRef = ref(null)
const cropperReady = ref(false)

const stencilComponent = computed(() => {
	return props.stencilType === "circle" ? CircleStencil : 'rectangle-stencil'
})

onMounted(() => {
	preview.value = props.previousImage
})

const imageUploaded = (e) => {
	error.value = ""

	const files = e.target.files || e.dataTransfer.files
	// check if we have a file, if it is the correct format and size
	if (!files.length) return
	if(!/\.(jpe?g|png|gif)$/i.test(files[0].name)) {
		error.value = "Je kunt alleen bestanden uploaden met het type .jpg, .jpeg, .png of .gif."
		return
	}
	if (files[0].size > props.maxSize) {
		error.value = "Je kunt alleen bestanden uploaden kleiner dan 5MB."
		return
	}

	uploadOpen.value = true
	isLoading.value = true

	// clear previous image
	if (uploaded.value) clearInputs()

	// read file as base64 string
	const reader = new FileReader()

	reader.onload = e => {
		uploaded.value = e.target.result
		isLoading.value = false
	}
	reader.readAsDataURL(files[0])
}

const setReady = () => {
	cropperReady.value = true
}

const crop = () => {
	isLoading.value = true
	const { coordinates, canvas, } = cropperRef.value.getResult()
	preview.value = canvas.toDataURL();
	uploadOpen.value = false
	isLoading.value = false
}

const cancelUpload = () => {
	clearInputs()
	uploadOpen.value = false
}

const cancelDelete = () => {
	deleteOpen.value = false
}

const deleteClick = (e) => {
	e.preventDefault()
	deleteOpen.value = true
}

const clearInputs = () => {
	uploaded.value = preview.value = ""
}

const deleteImage = () => {
	clearInputs()
	if (props.previousImage && props.deleteRoute) {
		axios.post(props.deleteRoute).then((response) => {
			document.getElementById("toast-container").innerHTML = response.data
			deleteOpen.value = false
		})
	} else {
		deleteOpen.value = false
	}
}

const uploadImage = (e) => {
	e.preventDefault()
	uploadRef.value.click()
}

watch(preview, (value) => {
	emit('update:modelValue', value)
})

</script>

<style scoped>
.cropper {
	max-height: 400px;
	max-width: 600px;
	overflow: hidden;
}
</style>