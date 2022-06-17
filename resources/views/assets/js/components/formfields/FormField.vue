<template>
  <ValidatedFormField
    :id="id"
    :name="fieldName"
    :label="label"
    :required="required"
    :show-helper-text="showHelperText"
    v-bind="$attrs"
    :validation-mode="validationMode"
  >
    <input
      :id="id"
      v-model="data"
      :name="fieldName"
      :type="type"
      :step="inputStep"
      :list="'datalist-' + id"
      :placeholder="placeholder"
      :required="required"
      :disabled="disabled"
      :autocomplete="autocomplete"
      @input="updateInput"
      @focus="focusInput"
      @blur="blurInput"
    >
    <datalist
      v-if="(datalist || []).length != 0"
      :id="'datalist-' + id"
    >
      <option
        v-for="(option, index) in datalist"
        :key="index"
        :value="option"
      />
    </datalist>
  </ValidatedFormField>
</template>

<script>
  import {uuid} from '../../mixins/uuid';
  import ValidatedFormField from './ValidatedFormField';

  export default {
    name: 'FormField',
    components: {
      ValidatedFormField,
    },
    mixins: [
      uuid,
    ],
    inheritAttrs: false,
    props: {
      label: {
        type: String,
        default: '',
      },
      type: {
        type: String,
        default: 'text',
        validator(value) {
          return [
            'url',
            'text',
            'password',
            'tel',
            'search',
            'number',
            'email',
            'date',
            'datetime-local',
          ].includes(value);
        },
      },
      value: {
        type: [String, Number],
        default: '',
      },
      name: {
        type: String,
        default: '',
      },
      placeholder: {
        type: String,
        default: undefined, // eslint-disable-line no-undefined
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
        default: () => [],
      },
      autocomplete: {
        type: String,
        default: '',
      },
      validationMode: {
        type: String,
        default: 'eager',
      }
    },
    data() {
      return {
        data: '',
        showHelperText: false,
      }
    },
    computed: {
      inputStep() {
        return (this.type === 'number') ? this.step : undefined; // eslint-disable-line no-undefined
      },
      fieldName() {
        return (this.name !== '') ? this.name : this.id;
      },
    },
    watch: {
      value: {
        immediate: true,
        handler: function(newVal) {
          this.data = newVal;
        },
      },
    },
    methods: {
      updateInput() {
        this.$emit('input', this.data);
      },
      focusInput() {
        this.showHelperText = true;
      },
      blurInput() {
        this.showHelperText = false;
      },
    },
  }
</script>
