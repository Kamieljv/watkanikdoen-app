<template>
    <div>
        <div class="flex w-full justify-center items-center" style="color:var(--wkid-message-success)">
            <CheckIcon class="shrink-0" style="stroke: currentColor; height: 150px;" />
        </div>
        <p class="text-center">{{message}}</p>
    </div>
</template>
<script setup lang="ts">
import CheckIcon from '&/clarity-check-circle-line.svg'
const props = defineProps({
    message: {
        type: String,
        required: true,
    },
})
</script>