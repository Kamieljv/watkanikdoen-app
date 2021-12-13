<template>
    <article 
        class="flex flex-col overflow-hidden rounded-lg shadow-lg actie" 
        typeof="Article"
    >
        <meta property="name" :content="actie.title">
        <meta property="author" typeof="Person" content="admin">
        <meta property="dateModified" :content="new Date(actie.updated_at).toISOString()">
        <meta class="uk-margin-remove-adjacent" property="datePublished" :content="new Date(actie.created_at).toISOString()">

        <div class="flex-shrink-0" style="position:relative;">
            <a :href="actie.link">
                <img class="object-cover w-full h-48" :src="actie.image_path" alt="">
            </a>
            <ul class="categories-container p-2">
                <li 
                    v-for="category in actie.categories"
                    :key="category.id"
                    class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                >
                    <span class="text-gray-700" rel="category">
                        {{ category.name }}
                    </span>
                </li>
            </ul>
        </div>
        <div class="flex flex-col justify-between flex-1 bg-white">
            <div class="title-body-container p-3 relative">
                <a :href="actie.link" class="block">
                    <h3 class=" text-xl font-semibold leading-7 text-gray-900">
                        {{ actie.title }}
                    </h3>
                </a>
                <a :href="actie.link" class="block">
                    <p class="mt-3 text-sm leading-6 text-gray-500">
                        {{ actie.body }}
                    </p>
                </a>
            </div>
        </div>

        <div class="flex items-center p-3 bg-gray-50">
                <div class="flex-shrink-0">
                    <a href="#">
                        <img class="w-10 h-10 rounded-full" :src="actie.user.avatar_path" alt="">
                    </a>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium leading-5 text-gray-900">
                        {{ __("acties.written_by") }}<a href="#" class="hover:underline">{{ actie.user.name }}</a>
                    </p>
                    <div class="flex text-sm leading-5 text-gray-500">
                    {{ __("general.on") }} <time :datetime="actie.time_start" class="ml-1">{{ new Date(actie.time_start).toLocaleDateString() }}</time>
                    </div>
                </div>
            </div>

    </article>
</template>

<script>
    export default {
        name: 'ActieAgenda',
        props: {
            actie: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
            }
        },
        computed: {
            //
        },
        watch: {
            //
        },
        mounted() {
        },
        methods: {
            //
        }
    }
</script>

<style lang="scss" scoped>
    article.actie {
        position: relative;
        & .categories-container {
            position: absolute;
            top: 0;
            width: 100%;
        }
        & .title-body-container {
            height: 125px;
            overflow: hidden;
        }
        & .title-body-container:before {
            content:'';
            width:100%;
            height:100%;    
            position:absolute;
            left:0;
            top:0;
            background: linear-gradient(transparent 94px, white);
            pointer-events: none;
        }
    }
      
</style>

