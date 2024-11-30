<template>
    <article
        class="flex flex-col overflow-hidden rounded-lg shadow-lg cursor-pointer relative transition-all ease-out hover:translate-y-[-0.250rem] hover:shadow-[0_0_20px_rgba(0,0,0,0.30)]"
        typeof="Article"
    >
        <a :href="referentie.url" class="h-full not-prose" :title="referentie.title ">
            <meta property="name" :content="referentie.title">
            <meta property="author" typeof="Person" content="admin">
            <meta property="dateModified" :content="new Date(referentie.updated_at).toISOString()">
            <meta class="uk-margin-remove-adjacent" property="datePublished" :content="new Date(referentie.created_at).toISOString()">
            <div class="content flex flex-col h-full">
                <div class="flex-shrink-0" style="position:relative;">
                    <img v-if="referentie.linked_image" class="object-cover w-full h-[150px]" :src="referentie.linked_image.url" alt="">
                    <div v-else class="h-[150px] bg-gray-300 text-gray-400 flex items-center justify-center">
                        <LogoIcon style="fill: currentColor; height: 80px;" />
                    </div>
                    <ul v-if="referentie.themes.length <= 2" class="themes-container flex flex-wrap p-2 absolute top-0 w-full">
                        <li
                            v-for="theme in referentie.themes"
                            :key="theme.id"
                            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
                            :style="{backgroundColor: theme.color}"
                        >
                            <span class="text-white" rel="theme">
                                {{ theme.name }}
                            </span>
                        </li>
                    </ul>
                    <ul v-else class="themes-container flex flex-wrap p-2 absolute top-0 w-full">
                        <li
                            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white after:uppercase bg-gray-100 rounded"
                            :style="{backgroundColor: referentie.themes[0].color}"
                        >
                            <span class="text-white" rel="theme">
                                {{ referentie.themes[0].name }}
                            </span>
                        </li>
                        <li
                            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
                        >
                            <span class="text-gray-800" rel="theme">
                                +{{ referentie.themes.length - 1 }} thema's
                            </span>
                        </li>
                    </ul>
                </div>
                <ul v-if="referentie.themes.length <= 2" class="themes-container flex flex-wrap p-2 absolute top-0 w-full">
                    <li
                        v-for="theme in referentie.themes"
                        :key="theme.id"
                        class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
                        :style="{backgroundColor: theme.color}"
                    >
                        <span class="text-white" rel="theme">
                            {{ theme.name }}
                        </span>
                    </li>
                </ul>
                <ul v-else class="themes-container flex flex-wrap p-2 absolute top-0 w-full">
                    <li
                        class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white after:uppercase bg-gray-100 rounded"
                        :style="{backgroundColor: referentie.themes[0].color}"
                    >
                        <span class="text-white" rel="theme">
                            {{ referentie.themes[0].name }}
                        </span>
                    </li>
                    <li
                        class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
                    >
                        <span class="text-gray-800" rel="theme">
                            +{{ referentie.themes.length - 1 }} thema's
                        </span>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col justify-between flex-1 bg-white">
                <div class="title-body-container p-3 overflow-hidden relative">
                    <h3 class="line-clamp-2 uppercase text-xl font-semibold leading-7 text-gray-900">
                        {{ referentie.title }}
                    </h3>
                    <p class="my-2 line-clamp-3 text-sm text-gray-500" v-html="referentie.description"></p>
                </div>
            </div>
        </a>
    </article>
</template>

<script setup lang="ts">

import LogoIcon from '&/logo-icon.svg'

const props = defineProps({
    referentie: {
        type: Object,
        required: true,
    }
})
</script>

