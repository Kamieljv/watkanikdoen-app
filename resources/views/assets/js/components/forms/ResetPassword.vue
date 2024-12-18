<template>
    <div class="flex flex-col justify-center py-20 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold leading-none text-center text-gray-900 lg:text-5xl">
                {{ __("auth.new_password_setup") }}
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
                <Form
                    ref="validator"
                >
                    <form :action="routes.password_change" method="POST">
                        <slot name="csrf"/>

                        <input type="hidden" name="token" :value="token">

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

                        <!-- Password -->
                        <FormField
                            v-model="password"
                            label="Nieuw wachtwoord"
                            name="password"
                            type="password"
                            :rules="{min: minPasswordLength, required: true}"
                            autocomplete="new-password"
                        />

                        <!-- Password Confirmation -->
                        <FormField
                            v-model="passwordConfirm"
                            label="Nieuw wachtwoord bevestigen"
                            name="password_confirmation"
                            type="password"
                            :rules="{min: minPasswordLength, required: true, confirmed: {target: 'password'}}"
                            autocomplete="new-password"
                        />

                        <div class="flex flex-col items-center justify-center text-sm leading-5">
                            <span class="block w-full mt-5 rounded-md shadow-sm">
                                <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700">
                                    {{ __("auth.reset_password") }}
                                </button>
                            </span>
                        </div>

                    </form>
                </Form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { inject, ref } from 'vue';
import { sentenceCase } from '../../helpers/caseHelper.js'
const __ = inject('translate');

const props = defineProps({
    routes: {
        type: Object,
        required: true,
    },
    token: {
        type: String,
        default: false,
    },
    minPasswordLength: {
        type: Number,
        default: 10,
    },
})

const email = ref('');
const password = ref('');
const passwordConfirm = ref('');

</script>

