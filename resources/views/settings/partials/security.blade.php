@php
    $routes = [
        'security_put' => route('settings.security.put'),
    ];
@endphp

<div id="app">
	<Security
		:routes="{{ json_encode($routes) }}"
		:user="{{ auth()->user() }}"
		:min-password-length="{{ config('app.auth.min_password_length') }}"
		:errors="{{ $errors }}"
	>
		<template v-slot:csrf>
			{{ csrf_field() }}
		</template>
	</Security>
</div>

@push('scripts')
	<script type="application/javascript">
		var app = new Vue({
			el: '#app',
		});
	</script>
@endpush
