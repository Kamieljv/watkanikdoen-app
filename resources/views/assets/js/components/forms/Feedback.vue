<template>
  <div class="flex flex-col justify-center py-10 sm:py-20 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2
        class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900"
      >
        {{ __("feedback.title") }}
      </h2>
    </div>

    <div class="mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-md">
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
          ref="feedbackFormRef"
          method="POST"
          :action="routes.store"
          @submit="submit"
        >
          <div class="text-gray-700">
            <p>{{ __("feedback.subtitle") }}</p>
          </div>

          <!-- Name -->
          <FormField
            v-model="name"
            :label="__('feedback.name')"
            :placeholder="__('feedback.name_placeholder')"
            name="name"
            type="text"
            class="mt-6"
            :rules="{ max: 255 }"
            autocomplete="name"
          />

          <!-- Email -->
          <FormField
            v-model="email"
            :label="__('feedback.email')"
            :placeholder="__('feedback.email_placeholder')"
            name="email"
            type="email"
            class="mt-6"
            :rules="{ max: 255, email: true }"
            autocomplete="email"
          />

          <!-- Subject -->
          <FormField
            v-model="subject"
            :label="__('feedback.subject')"
            :placeholder="__('feedback.subject_placeholder')"
            name="subject"
            type="text"
            class="mt-6"
            :rules="{ max: 255 }"
          />

          <!-- Message -->
          <div class="mt-6">
            <label for="feedback-message" class="text-sm">
              {{ __("feedback.message") }}
              <span class="text-red-500">*</span>
            </label>
            <Field
              id="feedback-message"
              v-model="message"
              as="textarea"
              name="message"
              rows="6"
              :placeholder="__('feedback.message_placeholder')"
              :rules="{ required: true, max: 5000 }"
            />
            <ErrorMessage name="message" />
          </div>

          <div class="text-gray-700 mt-6">
            <p class="text-sm">{{ __("feedback.hcaptcha_description") }}</p>
          </div>

          <div class="mt-1">
            <vue-hcaptcha
              :sitekey="hCaptchaKey"
              @verify="updateCaptchaToken"
              @expired="hCaptchaDone = false"
            ></vue-hcaptcha>
          </div>

          <!-- Submit -->
          <div class="mt-6">
            <span class="block w-full rounded-md shadow-sm">
              <button
                type="submit"
                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700 disabled:bg-gray-200 disabled:text-gray-900 disabled:cursor-not-allowed"
                :disabled="!hCaptchaDone || isLoading"
              >
                <span v-if="!isLoading">{{ __("feedback.submit") }}</span>
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
          {{ __("feedback.success") }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Form, Field, ErrorMessage, type GenericObject } from "vee-validate";
import VueHcaptcha from "@hcaptcha/vue3-hcaptcha";
import axios from "axios";
import { useTranslate } from "@composables";
const __ = useTranslate();

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

const name = ref("");
const email = ref("");
const subject = ref("");
const message = ref("");
const currentErrors = ref<Record<string, string[]>>({});
const isLoading = ref(false);
const hCaptchaDone = ref(false);
const created = ref(false);
const feedbackFormRef = ref<InstanceType<typeof Form> | null>(null);

const updateCaptchaToken = (token: string) => {
  feedbackFormRef.value?.setValues({ "h-captcha-token": token });
  hCaptchaDone.value = true;
};

const submit = (values: GenericObject) => {
  isLoading.value = true;
  axios
    .post(props.routes.store, values)
    .then((response) => {
      if (response.data?.status == "created") {
        currentErrors.value = {};
        created.value = true;
      }
    })
    .catch((error) => {
      currentErrors.value = error.response?.data?.errors ?? {
        general: [error.message],
      };
    })
    .finally(() => {
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
