<template>
    <div class="p-8">
        <h2 class="text-center">{{message}}</h2>
        <div class="flex w-full justify-center items-center">
            <img :src="src" class="shrink-0 rounded-md mt-5" style="stroke: currentColor; height: 270px;"/>
        </div>
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
        src: {
            type: String,
            required: true,
        },
    },
}
</script>