<template>
    <div class="flex flex-col" :class="{'justify-center py-10 sm:py-20 sm:px-6 lg:px-8': !async}">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                {{ __("auth.register") }}
            </h2>
        </div>

        <div :class="{'mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-md': !async}">
            <div class="px-4 py-8 bg-white sm:px-10" :class="{'border shadow border-gray-50 sm:rounded-lg': !async}">
                <div v-if="!async">
                    <p class="mb-2 text-sm">{{ __("auth.account?") }}</p>
                    <span class="block w-full rounded-md shadow-sm">
                        <a :href="routes.login" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-blue-600 transition duration-150 ease-in-out border border-transparent rounded-md border-1 border-blue-600 hover:bg-blue-200">
                            {{ this.sentenceCase(__("auth.login")) }}
                        </a>
                    </span>
                    <hr class="my-5">
                </div>
                <div v-if="currentErrors && Object.keys(currentErrors).length > 0" class="p-3 mb-3 text-sm rounded-md failure">
                    <p
                        v-for="error in Object.keys(currentErrors)"
                        :key="error"
                    >
                        {{ currentErrors[error][0] }}
                    </p>
                </div>
                <ValidationObserver
                    ref="validator"
                >
                    <form ref="register_form" role="form" method="POST" @submit.prevent="handleSubmit" :action="routes.register">
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
                            v-model="passwordConfirm"
                            label="Wachtwoord bevestigen"
                            name="password_confirmation"
                            type="password"
                            :rules="{min: minPasswordLength, confirmed: {target: 'password'}}"
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
                </ValidationObserver>
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
        errors: {
            type: Object,
            default: () => {}
        },
        async: {
            type: Boolean,
            default: false,
        }
    },
    data() {
		return {
            name: '',
			email: '',
            password: '',
            passwordConfirm: '',
            termsApproved: false,
            currentErrors: null,
        }
	},
    methods: {
        handleSubmit() {
            if (this.async) {
                var formData = new FormData(this.$refs.register_form)
                var data = {}
                for (const [key, value] of formData) {
                    data[key] = value
                }
                this.$http.post(this.routes.register, data).then((response) => {
                    if (response.data.status == 'success') {
                        this.currentErrors = []
                        this.$emit('done', response.data.user)
                    }
                }).catch((error) => {
                    this.currentErrors = error.response.data.errors
                })
            } else {
                this.$refs.register_form.submit()
            }
        }
    },
    computed: {
        termsText() {
            return this.__("auth.accept_terms")
                .replace(':terms', this.routes.terms)
        }
    },
    mounted () {
        this.currentErrors = this.errors
    }
}
</script>
<style scoped>
    .failure {
        color: var(--wkid-message-error-dark);
        background: var(--wkid-message-error-light);
    }
</style>
