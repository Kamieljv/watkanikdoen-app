<template>
    <div                                        >
        <div class="col-span-2">
            We willen je graag op de hoogte houden van de status van je aanmeldingen 
            en je hier eventueel vragen over stellen. 
            Daarom vragen we je om in te loggen óf een account te maken.
        </div>
        <div v-if="!currentUser" class="grid grid-cols-1 md:grid-cols-2 max-w-4xl mx-auto flex-col my-6 md:divide-x">
            <div class="col-span-1 space-y-3">
                <Login
                    :routes="routes"
                    :min-password-length="minPasswordLength"
                    :async="true"
                    @done="authDone"
                />
            </div>
            <div class="col-span-1 space-y-3">
                <Register
                    :routes="routes"
                    :min-password-length="minPasswordLength"
                    :h-captcha-key="hCaptchaKey"
                    :async="true"
                    @done="authDone"
                />
            </div>
        </div>
        <div v-else class="grid grid-cols-1 max-w-4xl mx-auto flex-col my-6">
            <SuccessBlock message="Je bent al ingelogd of geregistreerd."/>
        </div>
    </div>
</template>

<script>

import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "AddActie",
    components: {
        //
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
        user: {
            type: Object, 
        },
        minPasswordLength: {
            type: Number,
            default: 10,
        },
    },
    data() {
        return {
            currentUser: null 
        }
    },
    methods: {
        authDone: function(user) {
            this.currentUser = user
            this.$emit('done', user)
        }
    },
    mounted() {
        this.currentUser = Object.keys(this.user).length === 0 ? null : this.user
    }
}
</script>