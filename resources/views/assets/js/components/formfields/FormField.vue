<template>
  <ValidatedFormField
    :id="id"
    :name="fieldName"
    :label="label"
    class="relative"
    :required="required"
    :show-helper-text="showHelperText"
    v-bind="$attrs"
    :validation-mode="validationMode"
  >
    <div class="relative">
      <input
        :id="id"
        v-model="data"
        :name="fieldName"
        :type="type"
        :step="step"
        :list="'datalist-' + id"
        :placeholder="placeholder"
        :required="required"
        :disabled="disabled"
        :autocomplete="autocomplete"
        :class="classes"
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
      <div
          v-if="clearable && data"
          class="absolute right-0 inset-y-0 flex items-center pr-3 ml-3 cursor-pointer"
          @click="resetValue"
      >
          <svg class="fill-current h-4 w-4 text-gray-400" viewBox="0 0 20 20">
              <path fill="currentColor" d="M11.469,10l7.08-7.08c0.406-0.406,0.406-1.064,0-1.469c-0.406-0.406-1.063-0.406-1.469,0L10,8.53l-7.081-7.08
              c-0.406-0.406-1.064-0.406-1.469,0c-0.406,0.406-0.406,1.063,0,1.469L8.531,10L1.45,17.081c-0.406,0.406-0.406,1.064,0,1.469
              c0.203,0.203,0.469,0.304,0.735,0.304c0.266,0,0.531-0.101,0.735-0.304L10,11.469l7.08,7.081c0.203,0.203,0.469,0.304,0.735,0.304
              c0.267,0,0.532-0.101,0.735-0.304c0.406-0.406,0.406-1.064,0-1.469L11.469,10z"></path>
          </svg>
      </div>
    </div>
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
            'time',
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
    },
    data() {
      return {
        data: '',
        showHelperText: false,
      }
    },
    computed: {
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
      resetValue() {
        this.data = ""
        this.$emit('input', this.data);
      }
    },
  }
</script>
