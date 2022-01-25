<template>
    <div class="w-full h-full">
		<!-- Form input element -->
        <div class="relative w-full h-full">
			<img v-if="preview" id="preview" :src="preview" class="w-full h-full object-cover" :class="{'rounded-full': viewportType === 'circle'}">
			<div v-else :class="{'rounded-full': viewportType === 'circle'}" class="flex items-center justify-center text-6xl w-full h-full text-white" :style="{background: defaultColor}">{{ defaultChar }}</div>
			<div class="absolute inset-0 w-full h-full">
				<input v-show="false" type="file" ref="upload" id="upload" @change="imageUploaded">
				<input type="hidden" :value="cropped" :name="fieldName">
				<div class="absolute bottom-0 w-full z-10 flex mb-3 space-x-1 items-center justify-center text-white">
					<button v-if="preview" @click="clearInputs" class="flex items-center justify-center cursor-pointer w-10 h-10 bg-black bg-opacity-75 hover:bg-opacity-100 rounded-full">
						<svg-vue icon="antdesign-delete-o" class="w-6 h-6" fill="currentColor" />
					</button>
					<button @click="uploadImage" class="flex items-center justify-center cursor-pointer w-10 h-10 bg-black bg-opacity-75 hover:bg-opacity-100 rounded-full">
						<svg-vue icon="antdesign-camera-o" class="w-6 h-6" fill="currentColor" />
					</button>
				</div>
			</div>
		</div>
		<!-- Edit (Crop/Move/Zoom) Modal -->
		<div id="upload-modal" class="fixed inset-0 z-[1001] overflow-y-auto" v-show="open">
			<div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
				<!-- Gray background -->
				<div @click="cancel" class="fixed inset-0 bg-black opacity-50">
				</div>
				<!-- Actual modal -->
				<div class="relative inline-block px-4 pt-5 pb-4 text-left bg-white rounded-lg shadow-xl mt-10" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
					<div>
						<div class="mt-3 text-center sm:mt-5">
							<h3 class="mb-5 text-lg font-medium leading-6 text-gray-900" id="modal-headline">
								{{ __("general.position_and_resize_photo") }}
							</h3>
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
					</div>
					<div class="mt-5 sm:mt-6">
						<span class="flex w-full rounded-md shadow-sm">
							<button @click="cancel" class="inline-flex justify-center w-full px-4 py-2 mr-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-transparent border-gray-300 rounded-md shadow-sm hover:text-gray-500 active:text-gray-800 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5" type="button">
								Annuleren
							</button>
							<button @click="crop" class="inline-flex justify-center w-full px-4 py-2 ml-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave sm:text-sm sm:leading-5" id="apply-crop" type="button">
								Toepassen
							</button>
						</span>
					</div>
				</div>
			</div>
		</div>
    </div>
</template>

<script>
	export default {
		name: "FormImage",
		props: {
			previousImage: {
				type: String,
				default: '',
			},
			previousBase64: {
				type: String,
				default: '',
			},
			fieldName: {
				type: String,
				required: true,
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
				default: 'square',
			},
			defaultChar: {
				type: String,
				default: '?',
			},
			defaultColor: {
				type: String,
				default: 'var(--wkid-pink)',
			},
		},
		data() {
			return {
				cropped: '',
				preview: '',
				open: false,
				isLoading: false,
			}
		},
		mounted() {
			this.preview = this.cropped = this.previousImage
		},
		methods: {
			imageUploaded(e) {
				var files = e.target.files || e.dataTransfer.files;
				if (!files.length) return;

				this.open = true;
				this.isLoading = true;

				var reader = new FileReader();
				reader.onload = e => {
					this.$refs.croppieRef.bind({
						url: e.target.result
					}).then(function(){
						var sliders = document.getElementsByClassName('cr-slider')
						for (var i = 0; i < sliders.length; i++) {
							sliders[i].setAttribute('min', '0.067')
							sliders[i].setAttribute('max', '1.5')
							sliders[i].setAttribute('aria-valuenow', '0.15')
						}
					})
				}

				reader.readAsDataURL(files[0]);

				setTimeout(() => {
					this.isLoading = false;
				}, 800);
			},
			crop() {
				// Current option will return a base64 version of the uploaded image with a size of 600px X 450px.
				let options = {
					type: 'base64',
					size: { width: this.width, height: this.width * this.ratio  },
					format: 'png',
					circle: false,
				};
				this.$refs.croppieRef.result(options, output => {
					this.preview = this.cropped = output;
					})
				this.open = false
			},
			cancel(e) {
				// clear input field
				this.clearInputs(e)
				this.open = false
			},
			clearInputs(e){
				e.preventDefault()
				this.preview = ''
				this.cropped = ''
			},
			uploadImage(e){
				e.preventDefault()
				this.$refs.upload.click()
			}
		},
	}
</script>