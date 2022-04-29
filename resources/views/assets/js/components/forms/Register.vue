<template>
    <div class="flex flex-col justify-center py-10 sm:py-20 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900 lg:text-5xl">
                {{ __("auth.register") }}
            </h2>
        </div>

        <div class="mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white border shadow border-gray-50 sm:rounded-lg sm:px-10">
                <p class="mb-2 text-sm">{{ __("auth.account?") }}</p>
                <span class="block w-full rounded-md shadow-sm">
                    <a :href="routes.login" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-blue-600 transition duration-150 ease-in-out border border-transparent rounded-md border-1 border-blue-600 hover:bg-blue-200">
                        {{ this.sentenceCase(__("auth.login")) }}
                    </a>
                </span>
                <hr class="my-5">
                <form role="form" method="POST" :action="routes.register">
                    <slot name="csrf"/>

                    <!-- Name -->
                    <FormField
                        v-model="name"
                        label="Naam"
                        name="name"
                        type="text"
                        :rules="{max: 50}"
                        autocomplete="name"
                        required
                    />

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
                        label="Wachtwoord"
                        name="password"
                        type="password"
                        :rules="{min: minPasswordLength}"
                        autocomplete="new-password"
                        password
                        required
                    />

                    <!-- Password Confirmation -->
                    <FormField
                        v-model="password"
                        label="Wachtwoord bevestigen"
                        name="password_confirmation"
                        type="password"
                        :rules="{min: minPasswordLength}"
                        autocomplete="new-password"
                        password
                        required
                    />
                    
                    <div class="mt-6">
                        <div class="h-captcha" :data-sitekey="hCaptchaKey"></div>
                    </div>

                    <div class="mt-6 flex">
                        <input v-model="termsApproved" name="terms" type="checkbox" id="termsCheckbox" class="mr-2">
                        <label for="termsCheckbox" class="text-sm text-gray-900" v-html="termsText">
                        </label>
                    </div>
                    <div class="flex flex-col items-center justify-center text-sm leading-5">
                        <span class="block w-full mt-5 rounded-md shadow-sm">
                            <button
                                id="submitBtn"
                                type="submit"
                                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700 disabled:bg-gray-200 disabled:text-gray-900 disabled:cursor-not-allowed"
                                :disabled="!termsApproved"
                            >
                                {{ __("auth.register") }}
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import { ValidationProvider } from 'vee-validate';
import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "Register",
    components: {
        ValidationProvider,
    },
    mixins: [
        caseHelper,
    ],
    props: {
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
    },
    data() {
		return {
            name: '',
			email: '',
            password: '',
            termsApproved: false,
        }
	},
    computed: {
        termsText() {
            return this.__("auth.accept_terms")
                .replace(':terms', this.routes.terms)
                .replace(':privacypolicy', this.routes.privacypolicy);
        }
    }
}
</script>

