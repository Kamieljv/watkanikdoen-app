<form action="{{ route('settings.security.put') }}" method="POST" enctype="multipart/form-data">
	<div class="relative flex flex-col p-6">
		
		<div>
			<label for="current_password" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Current Password") }}</label>
			<div class="mt-1 rounded-md shadow-sm">
				<input id="current_password" type="password" name="current_password"
				class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
			</div>
			@if ($errors->has('current_password'))
				<div class="mt-1 text-red-500">
					{{ $errors->first('current_password') }}
				</div>
			@endif
		</div>

		<div class="mt-5">
			<label for="password" class="block text-sm font-medium leading-5 text-gray-700">{{ __("New Password") }}</label>
			<div class="mt-1 rounded-md shadow-sm">
				<input id="password" type="password" name="password"
				class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
			</div>
			@if ($errors->has('password'))
				<div class="mt-1 text-red-500">
					{{ $errors->first('password') }}
				</div>
			@endif
		</div>

		<div class="mt-5">
			<label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Confirm") }} {{ __("New Password") }}</label>
			<div class="mt-1 rounded-md shadow-sm">
				<input id="password_confirmation" type="password" name="password_confirmation" 
				class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
			</div>
			@if ($errors->has('password_confirmation'))
				<div class="mt-1 text-red-500">
					{{ $errors->first('password_confirmation') }}
				</div>
			@endif
		</div>

		<input type="hidden" name="_method" value="PUT">
		{{ csrf_field() }}
		<div class="flex justify-end w-full mt-3">
			<button class="primary self-end w-auto">
				{{ __("Save") }}
			</button>
		</div>
	</div>
</form>