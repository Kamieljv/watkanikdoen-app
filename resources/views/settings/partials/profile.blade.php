@php
    $routes = [
        'profile_put' => route('settings.profile.put'),
		'delete_avatar' => route('settings.profile.deleteAvatar', auth()->user()->id),
    ];
@endphp

<div id="app">
	<Profile
		:routes="{{ json_encode($routes) }}"
		:user="{{ auth()->user() }}"
		:errors="{{ $errors }}"
	>
		<template v-slot:csrf>
			{{ csrf_field() }}
		</template>
	</Profile>
	<div class="relative flex flex-col p-6 text-gray-800">
		<h5>{{__('settings.profile.delete_account')}}</h5>
		<p>{{__('settings.profile.delete_account_text')}}</p>
		<a class="mt-5" href="/acties">
			<button class="danger">{{__('settings.profile.delete_account')}}</button>
		</a>
	</div>
</div>

@push('scripts')
	<script type="application/javascript">
		var app = new Vue({
			el: '#app',
		});
	</script>
@endpush