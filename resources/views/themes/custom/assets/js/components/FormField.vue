<template>
  <input
    :id="id"
    v-model="data"
    :name="fieldName"
    :class="classes"
    :type="type"
    :step="inputStep"
    :list="'datalist-' + id"
    :placeholder="placeholder"
    :required="required"
    :disabled="disabled"
    :autocomplete="autocomplete"
    :autofocus="autofocus"
    @input="updateInput"
    @focus="focusInput"
    @blur="blurInput"
  />
</template>

<script>
export default {
	name: "FormField",
	inheritAttrs: false,
	props: {
		label: {
			type: String,
			default: "",
		},
		type: {
			type: String,
			default: "text",
			validator(value) {
				return [
					"url",
					"text",
					"password",
					"tel",
					"search",
					"number",
					"email",
				].includes(value)
			}
		},
		value: {
			type: [String, Number],
			default: "",
		},
		name: {
			type: String,
			default: "",
		},
		icon: {
			type: String,
			default: "",
		},
		placeholder: {
			type: String,
			default: undefined,
		},
		required: {
			type: Boolean,
			default: false,
		},
		disabled: {
			type: Boolean,
			default: false,
		},
		step: {
			type: Number,
			default: 1,
		},
		datalist: {
			type: Array,
			default: () => []
		},
		autocomplete: {
			type: String,
			default: ""
		},
		autofocus: {
			type: Boolean,
			default: false,
		},
		classes: {
			type: String,
			default: ""
		}
	},
	data() {
		return {
			data: "",
			id: "",
			showHelperText: false,
		}
	},
	computed: {
		inputStep() {
			if (this.type === "number") {
				return this.step
			} else {
				return undefined
			}
		},
		fieldName() {
			return (this.name !== "") ? this.name : this.id
		},
	},
	watch: {
		value: {
			immediate: true,
			handler: function(newVal) {
				this.data = newVal
			},
		},
	},
	mounted() {
	},
	methods: {
		updateInput() {
			this.$emit("input", this.data)
		},
		focusInput() {
			this.showHelperText = true
		},
		blurInput() {
			this.showHelperText = false
		},
	},
}
</script>