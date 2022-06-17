<template>
    <div>
        <div class="flex w-full justify-center items-center" style="color:var(--wkid-message-success)">
            <svg-vue icon="clarity-check-circle-line" class="shrink-0" style="stroke: currentColor; height: 150px;"></svg-vue>
        </div>
        <p class="text-center">{{message}}</p>
    </div>
</template>
<script>
export default {
    name: "SuccessBlock",
    props: {
        message: {
            type: String,
            required: true,
        },
    },
}
</script>