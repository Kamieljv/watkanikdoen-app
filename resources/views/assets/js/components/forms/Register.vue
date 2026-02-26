<template>
  <div class="flex flex-col justify-center py-10 sm:py-20 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2
        class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900"
      >
        {{ __("auth.register") }}
      </h2>
    </div>

    <div class="mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-md">
      <div
        class="px-4 py-8 bg-white sm:px-10 border shadow border-gray-50 sm:rounded-lg"
      >
        <div>
          <p class="mb-2 text-sm">{{ __("auth.account?") }}</p>
          <span class="block w-full rounded-md shadow-sm">
            <a
              class="flex items-center cursor-pointer justify-center w-full px-4 py-2 text-sm font-medium text-blue-600 transition duration-150 ease-in-out border rounded-md border-1 border-blue-600 hover:bg-blue-200"
              @click="switchType('login')"
            >
              {{ sentenceCase(__("auth.login")) }}
            </a>
          </span>
          <hr class="my-5 border-gray-200" />
        </div>
        <div
          v-if="currentErrors && currentErrors.length > 0"
          class="p-3 mb-3 text-sm rounded-md failure"
        >
          <p v-for="(error, index) in currentErrors" :key="index">
            {{ error }}
          </p>
        </div>
        <Form
          ref="registerFormRef"
          method="POST"
          :action="props.routes.register"
          @submit="submit"
        >
          <!-- Name -->
          <FormField
            v-model="name"
            label="Naam"
            name="name"
            type="text"
            :rules="{ max: 50, required: true }"
            autocomplete="name"
          />

          <!-- Email -->
          <FormField
            v-model="email"
            label="E-mailadres"
            name="email"
            type="email"
            :rules="{ max: 70, email: true, required: true }"
            autocomplete="email"
          />

          <!-- Password -->
          <FormField
            v-model="password"
            label="Nieuw wachtwoord"
            name="password"
            type="password"
            :rules="`min:${props.minPasswordLength}|required`"
            autocomplete="new-password"
          />

          <!-- Password Confirmation -->
          <FormField
            v-model="passwordConfirm"
            label="Nieuw wachtwoord bevestigen"
            name="password_confirmation"
            type="password"
            :rules="`min:${props.minPasswordLength}|required|confirmed:@password`"
            autocomplete="new-password"
          />

          <div class="mt-6">
            <vue-hcaptcha
              :sitekey="props.hCaptchaKey"
              @verify="updateCaptchaToken"
            ></vue-hcaptcha>
          </div>

          <div class="mt-6 flex">
            <Checkbox
              id="termsCheckbox"
              v-model="termsApproved"
              :binary="true"
              name="termsCheckbox"
              class="mr-2"
            />
            <label
              v-sanitize.inline="termsText"
              for="termsCheckbox"
              class="text-sm text-gray-900"
            >
            </label>
          </div>
          <div
            class="flex flex-col items-center justify-center text-sm leading-5"
          >
            <span class="block w-full mt-5 rounded-md shadow-sm">
              <button
                id="submitBtn"
                type="submit"
                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700 disabled:bg-gray-200 disabled:text-gray-900 disabled:cursor-not-allowed"
                :disabled="!termsApproved || !hCaptchaDone || isLoading"
              >
                <span v-if="!isLoading">{{ __("auth.register") }}</span>
                <div v-else class="custom-loader"></div>
              </button>
            </span>
          </div>
        </Form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import axios from "axios";
import { Form } from "vee-validate";
import { computed, inject, ref } from "vue";
import { sentenceCase } from "../../helpers/caseHelper.js";
import VueHcaptcha from "@hcaptcha/vue3-hcaptcha";
const __: (key: string) => string = inject("translate");
const emit = defineEmits(["done", "switchType"]);

const props = defineProps({
  routes: {
    type: Object,
    required: true,
  },
  minPasswordLength: {
    type: Number,
    default: 10,
  },
  hCaptchaKey: {
    type: String,
    required: true,
  },
  redirect: {
    type: Boolean,
    default: true,
  },
});

const name = ref("");
const email = ref("");
const password = ref("");
const passwordConfirm = ref("");
const termsApproved = ref(false);
const currentErrors = ref([]);
const registerFormRef = ref(null);
const hCaptchaDone = ref(false);
const isLoading = ref(false);

const updateCaptchaToken = (token) => {
  registerFormRef.value.setValues({ "h-captcha-token": token });
  hCaptchaDone.value = true;
};

const submit = (values) => {
  isLoading.value = true;
  axios
    .post(props.routes.register, values)
    .then((response) => {
      if (response.data?.status == "success") {
        currentErrors.value = [];
        emit("done", response.data.userId);
        if (props.redirect && response.data.redirect) {
          window.location.href = response.data.redirect;
        }
      }
      isLoading.value = false;
    })
    .catch((error) => {
      currentErrors.value = Object.values(error.response.data.errors).flat();
      isLoading.value = false;
    });
};

const switchType = (type) => {
  emit("switchType", type);
};

const termsText = computed(() => {
  return __("auth.accept_terms").replace(":terms", props.routes.terms);
});
</script>
<style scoped>
.failure {
  color: var(--wkid-message-error-dark);
  background: var(--wkid-message-error-light);
}
</style>
