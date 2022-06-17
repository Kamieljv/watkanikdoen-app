<template>
    <div class="w-full h-full">
		<!-- Form input element -->
        <div class="relative h-32 h-full" :class="{'w-32': viewportType === 'circle'}">
			<img v-if="preview" id="preview" :src="preview" class="w-full h-full object-cover" :class="{'rounded-full': viewportType === 'circle'}">
			<div v-else :class="{'rounded-full': viewportType === 'circle'}" class="flex items-center justify-center text-6xl w-full h-full text-white" :style="{background: defaultColor}">{{ defaultChar }}</div>
			<div class="absolute inset-0 w-full h-full">
				<input v-if="!disabled" v-show="false" type="file" ref="upload" id="upload" @change="imageUploaded">
				<input v-if="!disabled" type="hidden" :value="cropped" :name="fieldName">
				<div v-if="!disabled" class="absolute bottom-0 w-full z-10 flex mb-3 space-x-1 items-center justify-center text-white">
					<button v-if="preview" @click="deleteClick" class="flex items-center justify-center cursor-pointer w-10 h-10 bg-black bg-opacity-75 hover:bg-opacity-100 rounded-full">
						<svg-vue icon="antdesign-delete-o" class="w-6 h-6" fill="currentColor" />
					</button>
					<button @click="uploadImage" class="flex items-center justify-center cursor-pointer w-10 h-10 bg-black bg-opacity-75 hover:bg-opacity-100 rounded-full">
						<svg-vue icon="antdesign-camera-o" class="w-6 h-6" fill="currentColor" />
					</button>
				</div>
			</div>
		</div>
		<!-- Error space -->
		<div class="w-full mt-1 text-red-500">
			{{ error }}
		</div>
		<!-- Edit (Crop/Move/Zoom) Modal -->
		<t-modal
			v-model="uploadOpen"
			:hideCloseButton="true"
		>
			<template v-slot:header>
				<h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
					{{ header }}
				</h3>
			</template>
			<div class="mt-3 text-center sm:mt-5">
				<vue-croppie
					ref="croppieRef"
					:boundary="{width: '100%', height: '300px'}"
					:viewport="{ width: 300, height: 300 * ratio, 'type': viewportType }"
					:enableResize="false"
					v-show="!isLoading"
				/>
				<div v-show="isLoading" class="flex justify-center items-center h-20">
					<svg class="animate-spin -ml-1 mr-3 h-8 w-8 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
						<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
						<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
					</svg>
				</div>
			</div>

			<template v-slot:footer>
				<div class="flex justify-between">
					<button @click="cancelUpload" class="inline-flex justify-center w-full px-4 py-2 mr-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-transparent border-gray-300 rounded-md shadow-sm hover:text-gray-500 active:text-gray-800 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5" type="button">
						Annuleren
					</button>
					<button @click="crop" class="inline-flex justify-center w-full px-4 py-2 ml-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 sm:text-sm sm:leading-5" id="apply-crop" type="button">
						Toepassen
					</button>
				</div>
			</template>
		</t-modal>
		<!-- Delete Modal -->
		<t-modal
			v-model="deleteOpen"
			variant="danger"
			header="Weet je zeker dat je de foto wil verwijderen?"
			:hideCloseButton="true"
		>
			Als je op "Ja" klikt wordt de foto voor goed verwijderd.
			<template v-slot:footer>
				<div class="flex justify-between">
					<button @click="cancelDelete" class="inline-flex justify-center w-full px-4 py-2 mr-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-transparent border-gray-300 rounded-md shadow-sm hover:text-gray-500 active:text-gray-800 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5" type="button">
						Annuleren
					</button>
					<button @click="deleteImage" class="inline-flex justify-center w-full px-4 py-2 ml-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-[color:var(--wkid-red)] hover:bg-[color:var(--wkid-red-dark)] focus:outline-none focus:border-blue-700 sm:text-sm sm:leading-5" type="button">
						Ja, ik weet het zeker
					</button>
				</div>
			</template>
		</t-modal>
    </div>
</template>

<script>
export default {
	name: "FormImage",
	props: {
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
		ratio: {
			type: Number,
			default: 0.7,
		},
		viewportType: {
			type: String,
			default: "square",
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
	},
	data() {
		return {
			cropped: "",
			preview: "",
			uploadOpen: false,
			deleteOpen: false,
			isLoading: false,
			error: "",
		}
	},
	mounted() {
		this.preview = this.previousImage
	},
	methods: {
		imageUploaded(e) {
			this.error = ""
			
			var files = e.target.files || e.dataTransfer.files
			// check if we have a file, if it is the correct format and size
			if (!files.length) return
			if(!/\.(jpe?g|png|gif)$/i.test(files[0].name)) {
				this.error = "Je kunt alleen bestanden uploaden met het type .jpg, .jpeg, .png of .gif."
				return
			}
			if (files[0].size > this.maxSize) {
				this.error = "Je kunt alleen bestanden uploaden kleiner dan 5MB."
				return
			}

			this.uploadOpen = true
			this.isLoading = true

			var reader = new FileReader()
			reader.onload = e => {
				this.$refs.croppieRef.bind({
					url: e.target.result
				}).then(function(){
					var sliders = document.getElementsByClassName("cr-slider")
					for (var i = 0; i < sliders.length; i++) {
						sliders[i].setAttribute("min", "0.067")
						sliders[i].setAttribute("max", "1.5")
						sliders[i].setAttribute("aria-valuenow", "0.15")
					}
				})
			}

			reader.readAsDataURL(files[0])

			setTimeout(() => {
				this.isLoading = false
			}, 800)
		},
		crop() {
			// Current option will return a base64 version of the uploaded image with a size of 600px X 450px.
			let options = {
				type: "base64",
				size: { width: this.width, height: this.width * this.ratio  },
				format: "png",
				circle: false,
			}
			this.$refs.croppieRef.result(options, output => {
				this.preview = this.cropped = output
			})
			this.uploadOpen = false
		},
		cancelUpload() {
			this.clearInputs()
			this.uploadOpen = false
		},
		cancelDelete() {
			this.deleteOpen = false
		},
		deleteClick(e){
			e.preventDefault()
			this.deleteOpen = true
		},
		clearInputs(){
			this.preview = ""
			this.cropped = ""
		},
		deleteImage(){
			this.clearInputs()
			if (this.previousImage && this.deleteRoute) {
				this.$http.post(this.deleteRoute).then((response) => {
					document.getElementById("toast-container").innerHTML = response.data
					this.deleteOpen = false
				})
			} else {
				this.deleteOpen = false
			}

		},
		uploadImage(e){
			e.preventDefault()
			this.$refs.upload.click()
		}
	},
	watch: {
		cropped: function(value) {
			this.$emit('input', value)
		}
	}
}
</script>