<template>
  <ValidationProvider
    v-slot="v"
    ref="provider"
    :mode="validationMode"
    :rules="rules"
    :name="name"
    slim
  >
    <div
      class="input-field"
      :class="v.classes"
    >
      <slot name="label">
        <label
          v-if="labelText"
          :for="id"
          class="text-sm"
        >
          {{ labelText }}
        </label>
      </slot>
      <slot />
      <span
        v-if="v.errors.length > 0"
        class="helper-text is-invalid text-sm italic"
      >
        {{ v.errors[0] }}
      </span>
      <span
        v-else-if="hasHelperText"
        class="helper-text"
      >
        {{ helperText }}
      </span>
    </div>
  </ValidationProvider>
</template>

<script>
  import {ValidationProvider, configure as veeValidateConfigure} from 'vee-validate';

  export default {
    name: 'ValidatedFormField',
    components: {
      ValidationProvider,
    },
    props: {
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
      },
    },
    computed: {
      hasHelperText() {
        return !this.hideHelperText && (this.helperText !== '');
      },
      labelText() {
        if (this.label === '') {
          return '';
        }
        const required = this.required
          || (typeof this.rules === 'string' && this.rules.includes('required'))
          || (typeof this.rules === 'object' && this.rules.required === true);
        return this.label + ((required && this.showRequiredMark)? '*' : '');

      },
    },
    mounted() {
      veeValidateConfigure({
        classes: this.validationClasses,
      });
    },
    methods: {
      validate(event) {
        this.$refs.provider.validate(event);
      },
    },
  };
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