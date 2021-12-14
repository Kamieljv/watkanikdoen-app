<template>
    <article 
        class="flex flex-col overflow-hidden rounded-lg shadow-lg actie relative" 
        typeof="Article"
    >
        <a :href="actie.link" class="h-full">
            <meta property="name" :content="actie.title">
            <meta property="author" typeof="Person" content="admin">
            <meta property="dateModified" :content="new Date(actie.updated_at).toISOString()">
            <meta class="uk-margin-remove-adjacent" property="datePublished" :content="new Date(actie.created_at).toISOString()">
            <div class="content flex flex-col h-full">
                <div class="flex-shrink-0" style="position:relative;">
                    <img class="object-cover w-full h-48" :src="actie.image_path" alt="">
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
                        <h3 class=" text-xl font-semibold leading-7 text-gray-900">
                            {{ actie.title }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ actie.body }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-col grow justify-between flex-1 bg-white">
                    <div class="details-container text-sm text-gray-500 p-3">
                        <div class="time">
                            <i class="far fa-calendar"></i> &nbsp; {{ actie.start }}<br/>
                        </div>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i> &nbsp; {{ actie.location_human }}
                        </div>
                    </div>
                </div>
                <div class="flex items-center p-3 bg-gray-200">
                    <div class="flex-shrink-0">
                        <a href="#">
                            <img class="w-10 h-10 rounded-full" :src="actie.user.avatar_path" alt="">
                        </a>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 text-gray-900">
                            {{ __("acties.organized_by") }}<a href="#" class="font-medium hover:underline">{{ actie.user.name }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </a>
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
        & .categories-container {
            position: absolute;
            top: 0;
            width: 100%;
        }
        & .title-body-container {
            height: 90px;
            overflow: hidden;
        }
    }
      
</style>

