<form action="{{ route('settings.security.put') }}" method="POST" enctype="multipart/form-data">
	<div class="relative flex flex-col p-6">
		
		<div>
			<label for="current_password" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Current Password") }}</label>
			<div class="mt-1 rounded-md shadow-sm">
				<input id="current_password" type="password" name="current_password"
				class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
			</div>
		</div>

		<div class="mt-5">
			<label for="password" class="block text-sm font-medium leading-5 text-gray-700">{{ __("New Password") }}</label>
			<div class="mt-1 rounded-md shadow-sm">
				<input id="password" type="password" name="password"
				class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
			</div>
		</div>

		<div class="mt-5">
			<label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Confirm") }} {{ __("New Password") }}</label>
			<div class="mt-1 rounded-md shadow-sm">
				<input id="password_confirmation" type="password" name="password_confirmation" 
				class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
			</div>
		</div>

		<input type="hidden" name="_method" value="PUT">
		{{ csrf_field() }}
		<div class="flex justify-end w-full mt-2">
			<button class="flex self-end justify-center w-auto px-4 py-2 mt-5 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700" dusk="update-profile-button">Update</button>
		</div>
	</div>
</form>