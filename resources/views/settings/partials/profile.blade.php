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