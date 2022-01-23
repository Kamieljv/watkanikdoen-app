@extends('theme::layouts.app')

@section('content')

	<div class="grid grid-cols-4 gap-3 px-8 mx-auto my-6 max-w-6xl xl:px-5">

		<!-- Left Settings Menu -->
		<div class="w-full mr-6 col-span-4 md:col-span-1">

			<div class="relative grid grid-cols-2 items-center justify-center w-full py-1 md:py-0 bg-white border rounded-lg border-gray-150">
				<h3 class="col-span-2 px-6 py-3 md:pb-3 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase">{{ __("menus.account") }}</h3>

				<a href="{{ route('settings', 'profile') }}" class="block col-span-1 md:col-span-2 relative w-full flex items-center px-6 py-3 text-sm font-medium leading-5 @if(Request::is('auth/settings/profile')){{ 'text-gray-900 bg-gray-50' }}@else{{ 'text-gray-600' }}@endif transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50">
					@svg('antdesign-user-o', ['style' => 'width: 20px; height: 20px;']) &nbsp;
					<span class="truncate">{{ __("Profile") }}</span>
					<span class="absolute left-0 block w-1 transition-all duration-300 ease-out rounded-full @if(Request::is('auth/settings/profile')){{ 'bg-blue-500 h-full top-0' }}@else{{ 'top-1/2 bg-gray-300 group-hover:top-0 h-0 group-hover:h-full' }}@endif "></span>
				</a>
				<a href="{{ route('settings', 'security') }}" class="block col-span-1 md:col-span-2 relative w-full flex items-center px-6 py-3 text-sm font-medium leading-5 @if(Request::is('auth/settings/security')){{ 'text-gray-900 bg-gray-50' }}@else{{ 'text-gray-600' }}@endif transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50">
					@svg('antdesign-lock-o', ['style' => 'width: 20px; height: 20px;']) &nbsp;
					<span class="truncate">{{ __("menus.security") }}</span>
					<span class="absolute left-0 block w-1 transition-all duration-300 ease-out rounded-full @if(Request::is('auth/settings/security')){{ 'bg-blue-500 h-full top-0' }}@else{{ 'top-1/2 bg-gray-300 group-hover:top-0 h-0 group-hover:h-full' }}@endif "></span>
				</a>
			</div>

		</div>
		<!-- End Settings Menu -->

		<div class="flex flex-col w-full bg-white border rounded-lg col-span-4 md:col-span-3 border-gray-150">
			<div class="flex flex-wrap items-center justify-between border-b border-gray-200 sm:flex-no-wrap">
	            <div class="relative p-6">
	                <h3 class="flex text-lg font-medium leading-6 text-gray-600">
						@if (Request::is('auth/settings/profile'))
							@svg('antdesign-user-o', ['style' => 'width: 20px; height: 20px;']) &nbsp;
						@elseif (Request::is('auth/settings/security'))
							@svg('antdesign-lock-o', ['style' => 'width: 20px; height: 20px;']) &nbsp;
						@endif
						{{ __("menus." . (str_replace('-', ' ', Request::segment(3)) ?? 'profile') . '_settings') }}
	                </h3>
	            </div>
	        </div>
			<div class="uk-card-body">
				@include('theme::settings.partials.' . $section)
			</div>
		</div>
	</div>

@endsection

@section('javascript')

	<style>
		#upload-crop-container .croppie-container .cr-resizer, #upload-crop-container .croppie-container .cr-viewport{
			box-shadow: 0 0 2000px 2000px rgba(255,255,255,1) !important;
			border: 0px !important;
		}
		.croppie-container .cr-boundary {
			border-radius: 50% !important;
			overflow: hidden;
		}
		.croppie-container .cr-slider-wrap{
			margin-bottom: 0px !important;
		}
		.croppie-container{
			height:auto !important;
		}
	</style>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.3.0/exif.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
	<script>

			var uploadCropEl = document.getElementById('upload-crop');
			var uploadLoading = document.getElementById('uploadLoading');

			function readFile() {
				input = document.getElementById('upload');
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						//$('.upload-demo').addClass('ready');
						uploadCrop.bind({
							url: e.target.result,
							orientation: 4
						}).then(function(){
							//uploadCrop.setZoom(0);
						});
					}

					reader.readAsDataURL(input.files[0]);
				}
				else {
					alert("Sorry - you're browser doesn't support the FileReader API");
				}
			}

			if(document.getElementById('upload')){
				document.getElementById('upload').addEventListener('change', function () {
					document.getElementById('upload-modal').__x.$data.open = true;
					uploadCropEl.classList.add('hidden');
					uploadLoading.classList.remove('hidden');
					setTimeout(function(){
						uploadLoading.classList.add('hidden');
						uploadCropEl.classList.remove('hidden');

						if(typeof(uploadCrop) != "undefined"){
							uploadCrop.destroy();
						}
						uploadCrop = new Croppie(uploadCropEl, {
							viewport: { width: 190, height: 190, type: 'square' },
							boundary: { width: 190, height: 190 },
							enableExif: true,
						});

						readFile();
					}, 800);
				});
			}

			function clearInputField(){
				document.getElementById('upload').value = '';
			}

			function applyImageCrop(){
				uploadCrop.result({type:'base64',size:'original',format:'png',quality:1}).then(function(base64) {
					document.getElementById('preview').src = base64;
					document.getElementById('uploadBase64').value = base64;
				});
			}

	</script>
@endsection
