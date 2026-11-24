<template>
  <!-- Same shape as BookItemList, with a question mark instead of a cover -->
  <article
    id="boekentip"
    class="min-h-48 border-2 border-(--wkid-pink) flex flex-col sm:flex-row rounded-lg shadow-lg overflow-hidden"
  >
    <div
      class="shrink-0 h-32 sm:h-auto w-full sm:w-30 flex items-center justify-center bg-linear-to-br from-gray-200 to-gray-500 text-white"
      aria-hidden="true"
    >
      <span class="text-8xl font-bold leading-none select-none">?</span>
    </div>
    <div class="bg-white p-4 flex-1 min-w-0">
      <h3 class="text-xl font-bold text-gray-900">
        {{ __("books.tip_title") }}
      </h3>
      <p class="mt-1 text-sm text-gray-500">
        {{ __("books.tip_subtitle") }}
      </p>

      <div
        v-if="created"
        class="mt-4 p-3 text-sm rounded-md success"
        role="status"
      >
        {{ __("books.tip_success") }}
      </div>

      <Form
        v-else
        ref="tipFormRef"
        class="mt-4 flex flex-col gap-3"
        @submit="submit"
      >
        <div
          v-if="Object.keys(currentErrors).length > 0"
          class="p-3 text-sm rounded-md failure"
        >
          <p v-for="error in Object.keys(currentErrors)" :key="error">
            {{ currentErrors[error][0] }}
          </p>
        </div>

        <FormField
          v-model="book"
          :placeholder="__('books.tip_book_placeholder')"
          name="book"
          type="text"
          :rules="{ required: true, max: 255 }"
        />

        <!-- Only shown once someone starts filling in the form, to keep the item compact -->
        <div v-if="book.length > 0" class="flex flex-col items-end">
          <p class="text-sm text-gray-700">
            {{ __("feedback.hcaptcha_description") }}
          </p>
          <vue-hcaptcha
            class="mt-1"
            :sitekey="hCaptchaKey"
            @verify="updateCaptchaToken"
            @expired="hCaptchaDone = false"
          ></vue-hcaptcha>
        </div>

        <div class="flex justify-end mt-1">
          <button
            type="submit"
            class="primary"
            :disabled="!hCaptchaDone || isLoading"
            data-umami-event="Book tip submitted"
          >
            <span v-if="!isLoading">{{ __("books.tip_submit") }}</span>
            <div v-else class="custom-loader"></div>
          </button>
        </div>
      </Form>
    </div>
  </article>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Form, type GenericObject } from "vee-validate";
import VueHcaptcha from "@hcaptcha/vue3-hcaptcha";
import axios from "axios";
import FormField from "../formfields/FormField.vue";
import { useTranslate } from "@composables";
const __ = useTranslate();

const props = defineProps({
  // POST endpoint of the feedback form (feedback.store)
  feedbackRoute: {
    type: String,
    required: true,
  },
  hCaptchaKey: {
    type: String,
    required: true,
  },
});

const book = ref("");
const currentErrors = ref<Record<string, string[]>>({});
const isLoading = ref(false);
const hCaptchaDone = ref(false);
const created = ref(false);
const tipFormRef = ref<InstanceType<typeof Form> | null>(null);

const updateCaptchaToken = (token: string) => {
  tipFormRef.value?.setValues({ "h-captcha-token": token });
  hCaptchaDone.value = true;
};

const submit = (values: GenericObject) => {
  isLoading.value = true;
  // The feedback endpoint requires a message: the book is the message
  axios
    .post(props.feedbackRoute, {
      subject: "Boekentip",
      message: values.book,
      "h-captcha-token": values["h-captcha-token"],
    })
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
