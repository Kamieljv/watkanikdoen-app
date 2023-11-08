<template>
    <div class="p-8">
        <h2 class="text-center mb-3">{{title}}</h2>
        <p class="text-center">{{message}}</p>
        <div class="flex w-full justify-center items-center">
            <img :src="src" class="shrink-0 rounded-md mt-5" style="stroke: currentColor; height: 270px;"/>
        </div>
    </div>
</template>
<script>
export default {
    name: "SuccessGIF",
    props: {
        title: {
            type: String,
            required: true,
        },
        message: {
            type: String,
            default: '',
        },
        src: {
            type: String,
            required: true,
        },
    },
}
</script>