<template>
    <div class="flex flex-col" :class="{'justify-center py-10 sm:py-20 sm:px-6 lg:px-8': !async}">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                {{ this.sentenceCase(__("auth.login")) }}
            </h2>
        </div>

        <div :class="{'mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-md': !async}">
            <div class="px-4 py-8 bg-white sm:px-10" :class="{'border shadow border-gray-50 sm:rounded-lg': !async}">
                <div v-if="!async">
                    <p class="mb-2 text-sm">{{ __("auth.no_account?") }}</p>
                    <span class="block w-full rounded-md shadow-sm">
                        <a :href="routes.register" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-blue-600 transition duration-150 ease-in-out border border-transparent rounded-md border-1 border-blue-600 hover:bg-blue-200">
                            {{ __("auth.register") }}
                        </a>
                    </span>
                    <hr class="my-5">
                </div>
                <div v-if="currentErrors.length > 0" class="error-container rounded-sm p-3">
                    <p v-for="e in currentErrors" :key="e" class="italic text-sm">{{e}}</p>
                </div>
                <form ref="login_form" @submit.prevent="handleSubmit" :action="routes.login"  method="POST" class="space-y-3">
                    <slot name="csrf"/>

                    <!-- Email -->
                    <FormField
                        v-model="email"
                        label="E-mailadres"
                        name="email"
                        type="email"
                        :rules="{max: 70, email: true}"
                        :show-required-mark="false"
                        autocomplete="email"
                        required
                    />
                    <!-- Password -->
                    <FormField
                        v-model="password"
                        label="Wachtwoord"
                        name="password"
                        type="password"
                        :show-required-mark="false"
                        autocomplete="password"
                        password
                        required
                    />
                    <!-- Remember me -->
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" :checked="remember === 'on'">
                            <label for="remember" class="block ml-2 text-sm leading-5 text-gray-900">
                                {{ __("auth.remember_me") }}
                            </label>
                        </div>

                        <div class="text-sm leading-5">
                            <a :href="routes.forgot_password" class="font-medium transition duration-150 ease-in-out text-[color:var(--wkid-blue)] focus:outline-none hover:underline hover:text-[color:var(--wkid-blue-dark)]">
                                {{ __("auth.forgot_password?") }}
                            </a>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700">
                                {{ this.sentenceCase(__("auth.login")) }}
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
	name: "Login",
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
        errors: {
            type: Object,
            default: () => {}
        },
        remember: {
            type: String,
            default: "off",
        },
        minPasswordLength: {
            type: Number,
            default: 10,
        },
        async: {
            type: Boolean,
            default: false,
        }
    },
    data() {
		return {
			email: '',
            password: '',
            currentErrors: '',
        }
	},
    methods: {
        handleSubmit() {
            if (this.async) {
                this.$http.post(this.routes.login, {
                    "email": this.email,
                    "password": this.password,
                }).then((response) => {
                    if (response.data.status == 'success') {
                        this.currentErrors = []
                        this.$emit('done', response.data.user)
                    } else {
                        this.currentErrors = [response.data.message]
                    }
                })
            } else {
                this.$refs.login_form.submit()
            }
        }
    }, 
    mounted() {
        this.currentErrors = Object.values(this.errors).map((v) => v[0])
    }
}
</script>
<style lang="scss" scoped>
    .error-container {
        color: var(--wkid-message-error-dark);
        background-color: var(--wkid-message-error-light);
    }
</style>

