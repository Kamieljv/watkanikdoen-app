<form action="{{ route('settings.profile.put') }}" method="POST" enctype="multipart/form-data">
	<div class="relative flex flex-col p-6">
		<div id="app" class="flex justify-start w-full mb-8 w-full h-32 lg:m-b0">
			<form-image
				previous-image="{{ auth()->user()->linked_image ? auth()->user()->linked_image->url . '?' . time() : '' }}"
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
				@if ($errors->has('name'))
					<div class="mt-1 text-red-500">
						{{ $errors->first('name') }}
					</div>
				@endif
			</div>

			<div class="mt-5">
				<label for="email" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Email Address") }}</label>
				<div class="mt-1 rounded-md shadow-sm">
					<input class="cursor-not-allowed" id="email" type="text" name="email" value="{{ Auth::user()->email }}" title="U kunt uw e-mailadres niet wijzigen." required disabled>
				</div>
				@if ($errors->has('email'))
					<div class="mt-1 text-red-500">
						{{ $errors->first('email') }}
					</div>
				@endif
			</div>

			<div class="flex justify-end w-full mt-3">
				<button class="primary self-end w-auto">
					{{ __("Save") }}
				</button>
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