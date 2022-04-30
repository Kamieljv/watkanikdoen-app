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
</div>

@push('scripts')
	<script type="application/javascript">
		var app = new Vue({
			el: '#app',
		});
	</script>
@endpush