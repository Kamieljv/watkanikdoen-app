<template>
    <div                                        >
        <div class="col-span-2">
            We willen je graag op de hoogte houden van de status van je aanmeldingen 
            en je hier eventueel vragen over stellen. 
            Daarom vragen we je om in te loggen óf een account te maken.
        </div>
        <div v-if="!currentUser" class="flex justify-center max-w-6xl mx-auto my-6 md:divide-x">
            <Login
                v-if="type === 'login'"
                class="w-full md:w-1/2"
                :routes="routes"
                :min-password-length="minPasswordLength"
                :async="true"
                @done="authDone"
                @switchType="type = $event"
            />
            <Register
                v-else
                class="w-full md:w-1/2"
                :routes="routes"
                :min-password-length="minPasswordLength"
                :h-captcha-key="hCaptchaKey"
                :async="true"
                @done="authDone"
                @switchType="type = $event"
            />
        </div>
        <div v-else class="grid grid-cols-1 max-w-6xl mx-auto flex-col my-6">
            <SuccessBlock message="Je bent al ingelogd of geregistreerd."/>
        </div>
    </div>
</template>

<script setup lang="ts">

import { onMounted, ref } from 'vue';
const emit = defineEmits(['done']);

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
    user: {
        type: Object, 
    },
})

const currentUser = ref(null)
const type = ref('login')
const authDone = (user) => {
    currentUser.value = user
    emit('done', user)
}

onMounted(() => {
    console.log(props.user)
    if (Object.keys(props.user).length > 0) {
        currentUser.value = props.user
    }
})
</script>