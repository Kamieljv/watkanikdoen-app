<template>
    <div class="flex space-x-1">
        <input disabled type="text" :value="copyableText" />
        <button @click="handleCopy" class="primary flex items-center" :class="{'success-button': copied, 'copy-button': !copied}">
            <CopyIcon v-if="!copied" class="w-5 h-5" fill="currentColor" />
            <CheckIcon v-else class="w-5 h-5" fill="currentColor" />
        </button>
    </div>
</template>
<script setup lang="ts">
import { ref, computed } from 'vue'
import CopyIcon from '&/clarity-copy-line.svg'
import CheckIcon from '&/antdesign-check-o.svg'

const props = defineProps({
    text: {
        type: String,
        default: '',
    },
    currentUrl: {
        type: Boolean,
        default: false,
    }
})

const copied = ref(false)

const copyableText = computed(() => {
    return props.currentUrl ? window.location.href : props.text
})

const handleCopy = () => {
    // Copy the text to clipboard
    navigator.clipboard.writeText(copyableText.value);
    copied.value = true;

    // Reset the copied state after 2 seconds
    setTimeout(() => {
        copied.value = false;
    }, 2000);
}

</script>
<style lang="scss" scoped>
    .success-button {
        @apply bg-green-600 hover:bg-green-600 focus:outline-none border-0 transition;   
    }
    .copy-button {
        @apply bg-gray-400 hover:bg-gray-500 active:bg-gray-500 focus:outline-none border-0;   
    }
</style>