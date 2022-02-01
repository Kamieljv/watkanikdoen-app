<form action="{{ route('settings.profile.put') }}" method="POST" enctype="multipart/form-data">
	<div class="relative flex flex-col p-6">
		<div id="app" class="flex justify-start w-full mb-8 w-32 h-32 lg:m-b0">
			<form-image
				previous-image="{{ auth()->user()->avatar_path ? auth()->user()->avatar_path . '?' . time() : '' }}"
				field-name="avatar"
				viewport-type="circle"
				default-char="{{ substr(auth()->user()->name, 0, 1) }}"
				header="{{ __("general.position_and_resize_photo") }}"
				:ratio="1"
				delete-route="{{ route('settings.profile.deleteAvatar', auth()->user()->id) }}"
			/>
		</div>
		<div class="w-full lg:w-9/12 xl:w-4/5">
			<div>
				<label for="name" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Name") }}</label>
				<div class="mt-1 rounded-md shadow-sm">
					<input id="name" type="text" name="name" value="{{ Auth::user()->name }}" required>
				</div>
			</div>

			<div class="mt-5">
				<label for="email" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Email Address") }}</label>
				<div class="mt-1 rounded-md shadow-sm">
					<input id="email" type="text" name="email" value="{{ Auth::user()->email }}" required>
				</div>
			</div>

			<div class="flex justify-end w-full">
				<button class="flex self-end justify-center w-auto px-4 py-2 mt-5 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave active:bg-blue-700" dusk="update-profile-button">{{ __("Save") }}</button>
			</div>
		</div>
	</div>

	{{ csrf_field() }}
</form>

@push('scripts')
	<script type="application/javascript">
		var app = new Vue({
			el: '#app',
		});
	</script>
@endpush