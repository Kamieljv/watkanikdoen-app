<template>
    <div class="flex space-x-1">
        <input disabled type="text" :value="copyableText" />
        <button @click="handleCopy" class="primary flex items-center" :class="{'success-button': copied, 'copy-button': !copied}">
            <svg-vue v-if="!copied" icon="clarity-copy-line" class="w-5 h-5" fill="currentColor" />
            <svg-vue v-else icon="antdesign-check-o" class="w-5 h-5" fill="currentColor" />
        </button>
    </div>
</template>
<script>
export default {
    name: "CopyTextField",
    props: {
        text: {
            type: String,
            default: '',
        },
        currentUrl: {
            type: Boolean,
            default: false,
        }
    },
    data() {
        return {
            copied: false
        }
    },
    computed: {
        copyableText: function() {
            return this.currentUrl ? window.location.href : this.text
        }
    },
    methods: {
        handleCopy: function() {
            // Copy the text to clipboard
            navigator.clipboard.writeText(this.copyableText);
            this.copied = true;
        }
    }
}
</script>
<style lang="scss" scoped>
    .success-button {
        @apply bg-green-600 hover:bg-green-600 focus:outline-none border-0;   
    }
    .copy-button {
        @apply bg-gray-400 hover:bg-gray-500 active:bg-gray-500 focus:outline-none border-0;   
    }
</style>