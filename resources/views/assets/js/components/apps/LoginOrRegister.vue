<template>
  <div>
    <div
      v-if="!currentUserId"
      class="flex justify-center max-w-6xl mx-auto my-6 md:divide-x"
    >
      <Login
        v-if="type === 'login'"
        class="w-full md:w-1/2"
        :routes="routes"
        :min-password-length="minPasswordLength"
        :redirect="redirect"
        @done="authDone"
        @switch-type="type = $event"
      />
      <Register
        v-else
        class="w-full md:w-1/2"
        :routes="routes"
        :min-password-length="minPasswordLength"
        :redirect="redirect"
        :h-captcha-key="hCaptchaKey"
        @done="authDone"
        @switch-type="type = $event"
      />
    </div>
    <div
      v-else-if="!redirect && currentUserId"
      class="grid grid-cols-1 max-w-6xl mx-auto flex-col my-6"
    >
      <SuccessBlock message="Je bent al ingelogd of geregistreerd." />
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
const emit = defineEmits(["done"]);

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
  userId: {
    type: Number,
    default: null,
  },
  redirect: {
    type: Boolean,
    default: true,
  },
  type: {
    type: String,
    default: "login",
  },
});

const currentUserId = ref(props.userId);

const type = ref(props.type);

const authDone = (userId) => {
  currentUserId.value = userId;
  emit("done", userId);
};
</script>
