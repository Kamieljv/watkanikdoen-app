<template>
	<Field v-slot="v" ref="providerRef" :mode="validationMode" :rules="rules" :name="name" slim>
		<div class="input-field" :class="v.classes">
			<slot name="label">
				<label v-if="labelText" :for="id" class="text-sm">
					{{ labelText }}
				</label>
			</slot>
			<slot />
			<span v-if="v.errors.length > 0" class="helper-text is-invalid text-sm italic">
				{{ v.errors[0] }}
			</span>
			<span v-else-if="hasHelperText" class="helper-text">
				{{ helperText }}
			</span>
		</div>
	</Field>
</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';


	const props = defineProps({
		label: {
			type: String,
			default: '',
		},
		id: {
			type: String,
			required: true,
		},
		name: {
			type: String,
			required: true,
		},
		helperText: {
			type: String,
			default: '',
		},
		hideHelperText: {
			type: Boolean,
			default: false,
		},
		required: {
			type: Boolean,
			default: false,
		},
		rules: {
			type: [Object, String],
			default: '',
		},
		showRequiredMark: {
			type: Boolean,
			default: true,
		},
		validationMode: {
			type: String,
			default: 'eager',
		},
		validationClasses: {
			type: Object,
			default: () => ({
				valid: 'is-valid',
				invalid: 'is-invalid',
			}),
		}
	})

	const providerRef = ref(null);

	const hasHelperText = computed(() => {
		return !props.hideHelperText && (props.helperText !== '');
	})
	const labelText = computed(() => {
		if (props.label === '') {
			return '';
		}
		const required = props.required
			|| (typeof props.rules === 'string' && props.rules.includes('required'))
			|| (typeof props.rules === 'object' && props.rules.required === true);
		return props.label + ((required && props.showRequiredMark) ? '*' : '');
	}) 

	onMounted(() => {
		// configure({
		// 	classes: props.validationClasses,
		// });
	})

	const validate = (event) => {
		if (providerRef.value) {
			providerRef.value.validate(event);
		}
	}

</script>

<style lang="scss" scoped>
.input-field {
	&.is-valid {
		.helper-text {
			color: green;
		}
	}

	&.is-invalid {
		.helper-text {
			color: red;
		}
	}

	.is-invalid {
		color: red;
	}
}
</style>