<template>
    <div class="flex flex-col justify-center py-10 sm:py-20 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-lg">
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                {{ this.sentenceCase(__("newsletter.title")) }}
            </h2>
        </div>

        <div class="mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-lg">
            <div v-if="!created" class="px-4 py-8 bg-white sm:px-10 border shadow border-gray-50 sm:rounded-lg">
                <div v-if="currentErrors && Object.keys(currentErrors).length > 0" class="p-3 mb-3 text-sm rounded-md failure">
                    <p
                        v-for="error in Object.keys(currentErrors)"
                        :key="error"
                    >
                        {{ currentErrors[error][0] }}
                    </p>
                </div>
                <Form
                    ref="validator"
                >
                    <form ref="newsletter_form" @submit.prevent="handleSubmit"  method="POST">
                        <slot name="csrf"/>

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
                            :rules="{max: 70, email: true}"
                            :show-required-mark="false"
                            autocomplete="email"
                            required
                        />

                        <div class="text-gray-700 mt-6">
                            <p class="text-sm">{{ __("newsletter.hcaptcha_description") }}</p>
                        </div>

                        <div class="mt-1">
                            <div class="h-captcha" :data-sitekey="hCaptchaKey"></div>
                        </div>

                        <div class="mt-6 flex">
                            <input v-model="termsApproved" name="terms" type="checkbox" id="termsCheckbox" class="mr-2">
                            <label for="termsCheckbox" class="text-sm text-gray-900" v-html="termsText">
                            </label>
                        </div>

                        <!-- Submit -->
                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button 
                                    type="submit" 
                                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700 disabled:bg-gray-200 disabled:text-gray-900 disabled:cursor-not-allowed"
                                    :disabled="!termsApproved || isLoading">
                                        <span v-if="!isLoading">{{ this.sentenceCase(__("newsletter.subscribe")) }}</span>
                                        <div v-else class="custom-loader"></div>
                                </button>
                            </span>
                        </div>
                    </form>
                </Form>
            </div>
            <div v-else class="px-4 py-8 bg-white sm:px-10 border shadow border-gray-50 sm:rounded-lg">
                <div class="p-3 text-sm rounded-md success">
                    {{ __("newsletter.verification_email_sent") }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "Newsletter",
    mixins: [
        caseHelper,
    ],
    props: {
        routes: {
            type: Object,
            required: true,
        },
        hCaptchaKey: {
            type: String,
            required: true
        },
    },
    data() {
		return {
			email: '',
            currentErrors: '',
            isLoading: false,
            termsApproved: false,
            created: false
        }
	},
    methods: {
        handleSubmit() {
            this.isLoading = true
            var formData = new FormData(this.$refs.newsletter_form)
            var data = {}
            for (const [key, value] of formData) {
                data[key] = value
            }
            this.$http.post(this.routes.subscribe, data).then((response) => {
                if (response.data.status == 'created') {
                    this.currentErrors = []
                    this.created = true
                    this.isLoading = false
                }
            }).catch((error) => {
                this.currentErrors = error.response.data.errors
                this.isLoading = false
            })
        }
    }, 
    computed: {
        termsText() {
            return this.__("auth.accept_terms")
                .replace(':terms', this.routes.terms)
        }
    }
}
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

