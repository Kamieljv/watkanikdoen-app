<template>
  <div class="p-6">
    <div
      v-if="Object.keys(props.errors).length > 0"
      class="p-3 mb-3 text-sm rounded-md failure"
    >
      <span v-for="error in Object.keys(props.errors)" :key="error">
        {{ props.errors[error][0] }}
      </span>
    </div>
    <form
      :action="props.routes.security_put"
      method="POST"
      enctype="multipart/form-data"
    >
      <slot name="csrf" />
      <div class="relative flex flex-col">
        <!-- Current Password -->
        <FormField
          v-model="password"
          label="Huidig Wachtwoord"
          name="current_password"
          type="password"
          autocomplete="password"
          password
          required
        />

        <!-- New Password -->
        <FormField
          v-model="newPassword"
          label="Wachtwoord"
          name="password"
          type="password"
          :rules="{ min: props.minPasswordLength }"
          autocomplete="new-password"
          password
          required
        />

        <!-- New Password Confirmation -->
        <FormField
          v-model="newPasswordConfirm"
          label="Wachtwoord bevestigen"
          name="password_confirmation"
          type="password"
          :rules="{
            min: props.minPasswordLength,
            confirmed: { target: 'password' },
          }"
          autocomplete="new-password"
          password
          required
        />
        <input type="hidden" name="_method" value="PUT" />
        <div class="flex justify-end w-full mt-2">
          <button
            class="flex self-end justify-center w-auto px-4 py-2 mt-5 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700"
            dusk="update-profile-button"
          >
            {{ __("general.save") }}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { inject, ref } from "vue";
const __: (key: string) => string = inject("translate");

const props = defineProps({
  routes: {
    type: Object,
    required: true,
  },
  minPasswordLength: {
    type: Number,
    default: 10,
  },
  errors: {
    type: Object,
    default: () => ({}),
  },
});

const password = ref("");
const newPassword = ref("");
const newPasswordConfirm = ref("");
</script>

<style scoped>
.failure {
  color: var(--wkid-message-error-dark);
  background: var(--wkid-message-error-light);
}
</style>
