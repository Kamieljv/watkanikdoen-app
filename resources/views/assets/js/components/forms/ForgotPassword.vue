<template>
    <div class="flex flex-col justify-center py-20 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900 lg:text-5xl">
                {{ __("auth.reset_password") }}
            </h2>
            <p class="mt-4 text-sm leading-5 text-center text-gray-600 max-w">
                {{ __("general.or_back_to") }}
                <a :href="routes.login" class="font-medium transition duration-150 ease-in-out text-blue-600 hover:text-blue-500 focus:outline-none focus:underline">
                    {{ sentenceCase(__('auth.login')) }}
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white border shadow border-gray-50 sm:rounded-lg sm:px-10">
                <div
                    v-if="responseMessage && success"
                    v-html="responseMessage"
                    class="p-3 text-sm rounded-md success"
                ></div>
                <div v-else-if="success == false" class="p-3 text-sm rounded-md failure">
                    {{ __("auth.reset_link_send_failed") }}
                </div>
                <form v-if="success == null" action="#" method="POST">
                    <!-- Email -->
                    <FormField
                        v-model="email"
                        label="E-mailadres"
                        name="email"
                        type="email"
                        :rules="{max: 70, email: true}"
                        autocomplete="email"
                        required
                    />

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <a @click="submit" class="flex justify-center w-full px-4 py-2 text-sm cursor-pointer font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700">
                                <span v-if="!isLoading">{{ __("auth.send_reset_link") }}</span>
                                <div v-else class="custom-loader"></div>
                            </a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { ref } from 'vue';
import { sentenceCase } from "../../helpers/caseHelper.js";
import _ from 'lodash';
import axios from 'axios';
const __ = str => _.get(window.i18n, str)

const props = defineProps({
    routes: {
        type: Object,
        required: true,
    },
    csrf: {
        type: String,
        required: true,
    },
});

const email = ref('');
const responseMessage = ref('');
const success = ref(null);
const isLoading = ref(false);

const submit = async function() {
    isLoading.value = true;
    try {
        const response = await axios.post(props.routes.password_reset, {
            email: email.value,
            _token: props.csrf,
        });
        responseMessage.value = response.data.message;
        success.value = true;
    } catch (err) {
        success.value = false;
    }
    isLoading.value = false;
}

</script>

<style scoped>
    .success {
        color: var(--wkid-message-success-dark);
        background: var(--wkid-message-success-light);
    }
    .failure {
        color: var(--wkid-message-error-dark);
        background: var(--wkid-message-error-light);
    }
</style>

