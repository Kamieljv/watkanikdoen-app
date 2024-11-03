<template>
	<div class="flex">
		<div class="relative flex-item">
			<slot name="label">
				<label v-if="label" :for="id" class="text-sm">
					{{ label }}
					<span v-if="isRequired" class="text-red-500">*</span>
				</label>
			</slot>
			<div class="flex h-full">
				<Field ref="fieldRef" :id="id" v-model="data" :name="fieldName" :type="type" :step="step" :list="'datalist-' + id"
					:placeholder="placeholder" :rules="rules" :disabled="disabled" :autocomplete="autocomplete"
					:class="classes" @update:modelValue="updateInput" @focus="focusInput" @blur="blurInput" />
				<slot name="button-right" />
			</div>
			<ErrorMessage :name="fieldName" />
			<datalist v-if="(datalist || []).length != 0" :id="'datalist-' + id">
				<option v-for="(option, index) in datalist" :key="index" :value="option" />
			</datalist>
			<div v-if="clearable && data"
				class="absolute right-0 inset-y-0 flex items-center pr-3 ml-3 cursor-pointer" @click="resetValue">
				<svg class="fill-current h-4 w-4 text-gray-400" viewBox="0 0 20 20">
					<path fill="currentColor" d="M11.469,10l7.08-7.08c0.406-0.406,0.406-1.064,0-1.469c-0.406-0.406-1.063-0.406-1.469,0L10,8.53l-7.081-7.08
			c-0.406-0.406-1.064-0.406-1.469,0c-0.406,0.406-0.406,1.063,0,1.469L8.531,10L1.45,17.081c-0.406,0.406-0.406,1.064,0,1.469
			c0.203,0.203,0.469,0.304,0.735,0.304c0.266,0,0.531-0.101,0.735-0.304L10,11.469l7.08,7.081c0.203,0.203,0.469,0.304,0.735,0.304
			c0.267,0,0.532-0.101,0.735-0.304c0.406-0.406,0.406-1.064,0-1.469L11.469,10z"></path>
				</svg>
			</div>
		</div>
		<slot>
			<div class="slot-default"></div>
		</slot>
	</div>
</template>

<script setup lang="ts">
	import { watch, ref, computed } from 'vue';
	import { Field, ErrorMessage } from 'vee-validate';
	import { v4 as uuidFunc } from 'uuid';
	const emit = defineEmits(['update:modelValue'])

	const props = defineProps({
		label: {
			type: String,
			default: '',
		},
		type: {
			type: String,
			default: 'text',
			validator: (value: string) => {
				return [
					'url',
					'text',
					'password',
					'tel',
					'search',
					'number',
					'email',
					'date',
					'time',
					'datetime-local',
					'hidden'
				].includes(value);
			},
		},
		name: {
			type: String,
			default: '',
		},
		placeholder: {
			type: String,
			default: undefined, // eslint-disable-line no-undefined
		},
		disabled: {
			type: Boolean,
			default: false,
		},
		rules: {
			type: [Object, String],
			default: '',
		},
		step: {
			type: String,
			default: '',
		},
		datalist: {
			type: Array,
			default: () => [],
		},
		autocomplete: {
			type: String,
			default: '',
		},
		validationMode: {
			type: String,
			default: 'eager',
		},
		classes: {
			type: String,
			default: ''
		},
		clearable: {
			type: Boolean,
			default: false,
		}
	})

	const value = defineModel()

	const data = ref(null)
	const showHelperText = ref(false)
	const id = uuidFunc()
	const fieldRef = ref(null)

	const fieldName = computed(() => {
		return (props.name !== '') ? props.name : id.value
	})

	const isRequired = computed(() => {
		if (typeof props.rules === 'string') {
			return props.rules.includes('required')
		} else if (typeof props.rules == 'object') {
			return props.rules.required
		}
	})

	watch(
		value,
		(newVal) => {
			data.value = newVal
		},
		{ immediate: true }
	)

	const updateInput = () => {
		emit('update:modelValue', data.value);
	}
	const focusInput = () => {
		showHelperText.value = true;
	}

	const blurInput = () => {
		showHelperText.value = false;
	}

	const resetValue = () => {
		data.value = ""
		emit('update:modelValue', data.value);
	}

	defineExpose({
        fieldRef
    })

</script>
<style scoped>
.slot-default {
	flex: 0 0 auto;
}

.flex-item {
	flex: 1 1 auto;
}
</style>
