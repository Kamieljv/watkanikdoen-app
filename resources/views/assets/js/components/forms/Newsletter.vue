<template>
  <div class="flex flex-col justify-center py-10 sm:py-20 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
      <h2
        class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900"
      >
        {{ sentenceCase(__("newsletter.title")) }}
      </h2>
    </div>

    <div class="mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-lg">
      <div
        v-if="!created"
        class="px-4 py-8 bg-white sm:px-10 border shadow border-gray-50 sm:rounded-lg"
      >
        <div
          v-if="currentErrors && Object.keys(currentErrors).length > 0"
          class="p-3 mb-3 text-sm rounded-md failure"
        >
          <p v-for="error in Object.keys(currentErrors)" :key="error">
            {{ currentErrors[error][0] }}
          </p>
        </div>
        <Form
          ref="newsletterFormRef"
          method="POST"
          :action="routes.subscribe"
          @submit="submit"
        >
          <div class="text-gray-700">
            <p>{{ __("newsletter.subtitle") }}</p>
          </div>

          <!-- Email -->
          <FormField
            v-model="email"
            label="E-mailadres"
            name="email"
            type="email"
            class="mt-6"
            :rules="{ max: 70, email: true }"
            :show-required-mark="false"
            autocomplete="email"
            required
          />

          <div class="text-gray-700 mt-6">
            <p class="text-sm">{{ __("newsletter.hcaptcha_description") }}</p>
          </div>

          <div class="mt-1">
            <vue-hcaptcha
              :sitekey="hCaptchaKey"
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

          <!-- Submit -->
          <div class="mt-6">
            <span class="block w-full rounded-md shadow-sm">
              <button
                type="submit"
                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700 disabled:bg-gray-200 disabled:text-gray-900 disabled:cursor-not-allowed"
                :disabled="!termsApproved || !hCaptchaDone || isLoading"
              >
                <span v-if="!isLoading">{{
                  sentenceCase(__("newsletter.subscribe"))
                }}</span>
                <div v-else class="custom-loader"></div>
              </button>
            </span>
          </div>
        </Form>
      </div>
      <div
        v-else
        class="px-4 py-8 bg-white sm:px-10 border shadow border-gray-50 sm:rounded-lg"
      >
        <div class="p-3 text-sm rounded-md success">
          {{ __("newsletter.verification_email_sent") }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, inject, ref } from "vue";
import { Form } from "vee-validate";
import { sentenceCase } from "../../helpers/caseHelper.js";
import VueHcaptcha from "@hcaptcha/vue3-hcaptcha";
import axios from "axios";
const __: (key: string) => string = inject("translate");

const props = defineProps({
  routes: {
    type: Object,
    required: true,
  },
  hCaptchaKey: {
    type: String,
    required: true,
  },
});

const email = ref("");
const currentErrors = ref("");
const isLoading = ref(false);
const termsApproved = ref(false);
const hCaptchaDone = ref(false);
const created = ref(false);
const newsletterFormRef = ref(null);

const termsText = computed(() => {
  return __("auth.accept_terms").replace(":terms", props.routes.terms);
});

const updateCaptchaToken = (token) => {
  newsletterFormRef.value.setValues({ "h-captcha-token": token });
  hCaptchaDone.value = true;
};

const submit = (values) => {
  isLoading.value = true;
  axios
    .post(props.routes.subscribe, values)
    .then((response) => {
      if (response.data?.status == "created") {
        currentErrors.value = "";
        created.value = true;
        isLoading.value = false;
      }
    })
    .catch((error) => {
      currentErrors.value = error.response.data.errors;
      isLoading.value = false;
    });
};
</script>
<style lang="scss" scoped>
.success {
  color: var(--wkid-message-success-dark);
  background: var(--wkid-message-success-light);
}
.failure {
  color: var(--wkid-message-error-dark);
  background: var(--wkid-message-error-light);
}
</style>
