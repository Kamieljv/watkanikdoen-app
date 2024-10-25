<template>
    <div                                        >
        <div v-if="!currentUserId" class="flex justify-center max-w-6xl mx-auto my-6 md:divide-x">
            <Login
                v-if="type === 'login'"
                class="w-full md:w-1/2"
                :routes="routes"
                :min-password-length="minPasswordLength"
                :redirect="redirect"
                @done="authDone"
                @switchType="type = $event"
            />
            <Register
                v-else
                class="w-full md:w-1/2"
                :routes="routes"
                :min-password-length="minPasswordLength"
                :redirect="redirect"
                :h-captcha-key="hCaptchaKey"
                @done="authDone"
                @switchType="type = $event"
            />
        </div>
        <div v-else-if="!redirect" class="grid grid-cols-1 max-w-6xl mx-auto flex-col my-6">
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
    userId: {
        type: Number, 
    },
    redirect: {
        type: Boolean,
        default: true,
    }
})

const currentUserId = ref(null)
const type = ref('login')
const authDone = (userId) => {
    currentUserId.value = userId
    emit('done', userId)
}

onMounted(() => {
    if (props.userId) {
        currentUserId.value = props.userId
    }
})
</script>