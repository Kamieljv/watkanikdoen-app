<template>
    <article
        class="flex flex-col overflow-hidden rounded-lg shadow-lg actie relative transition-all ease-out hover:translate-y-[-0.250rem] hover:shadow-[0_0_20px_rgba(0,0,0,0.30)]"
        typeof="Article"
    >
        <a :href="actie.link" class="h-full not-prose" :class="{'opacity-70 grayscale': actie.afgelopen}" :title="actie.afgelopen ? 'Deze actie is afgelopen' : actie.title ">
            <meta property="name" :content="actie.title">
            <meta property="author" typeof="Person" content="admin">
            <meta v-if="actie.updated_at" property="dateModified" :content="new Date(actie.updated_at).toISOString()">
            <meta v-if="actie.created_at" class="uk-margin-remove-adjacent" property="datePublished" :content="new Date(actie.created_at).toISOString()">
            <div class="content flex flex-col h-full">
                <div class="flex-shrink-0" style="position:relative;">
                    <img v-if="actie.linked_image" class="object-cover w-full h-[150px]" :src="actie.linked_image.url" alt="">
                    <div v-else class="h-[150px] bg-gray-300 text-gray-400 flex items-center justify-center">
                        <LogoIcon style="fill: currentColor; height: 80px;" />
                    </div>
                    <div class="absolute top-0 p-2">
                        <ThemesChips :themes="actie.themes" :max-visible="3"></ThemesChips>
                    </div>
                    <div class="text-left p-2 absolute bottom-0 w-full">
                        <ul
                            class="categories-container flex flex-wrap"
                            v-if="actie.categories.length <= 2"
                        >
                            <li
                                v-for="category in actie.categories"
                                :key="category.id"
                                class="relative self-start inline-block bg-gray-100 px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                            >
                                <span class="flex items-center text-gray-800" rel="categorie">
                                    {{ category.name }}
                                </span>
                            </li>
                        </ul>
                        <ul
                            class="categories-container flex flex-wrap w-full"
                            v-else
                        >
                            <li
                                class="relative self-start inline-block px-2 py-1 mr-1 mt-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                            >
                                <span class="text-gray-800" rel="categorie">
                                    {{ actie.categories[0].name }}
                                </span>
                            </li>
                            <li
                                class="relative self-start inline-block px-2 py-1 mr-1 mt-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                            >
                                <span class="text-gray-800" rel="categorie">
                                    +{{ actie.categories.length - 1 }} categoriën
                                </span>
                            </li>
                        </ul>
                        <div
                            v-if="actie.distance"
                            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                        >
                            <span class="flex items-center" rel="theme">
                                <LocationIcon style="fill: currentColor; width: 14px; height: 14px;" />
                                &nbsp; {{ actie.distance + ' km' }}<br/>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-between flex-1 bg-white">
                    <div class="title-body-container p-3 overflow-hidden relative">
                        <h3 class="truncate uppercase text-xl font-semibold leading-7 text-gray-900">
                            {{ actie.title }}
                        </h3>
                        <p class="text-sm font-bold text-[color:var(--wkid-pink)]">{{actie.location_human.toUpperCase()}}<br/>{{actie.start_end.toUpperCase()}}</p>
                        <p class="my-2 line-clamp-3 text-sm text-gray-500" v-html="actie.body"></p>
                    </div>
                </div>
                <div v-if="actie.organizers.length > 0" class="flex items-center p-3 bg-gray-200">
                    <div class="flex-shrink-0">
                        <a :href="actie.organizers[0].link">
                            <img v-if="actie.organizers[0].linked_image" class="w-10 h-10 rounded-full" :src="actie.organizers[0].linked_image.url" :alt="actie.organizers[0].name" :title="actie.organizers[0].name">
                            <div v-else class="flex items-center justify-center text-xl w-10 h-10 rounded-full bg-gray-500 text-white">
                                {{ actie.organizers[0].name.charAt(0) }}
                            </div>
                        </a>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 text-gray-900">
                            {{ __("acties.organized_by") }}
                            <a :href="actie.organizers[0].link" class="font-medium hover:underline" style="color: inherit;">
                                {{ actie.organizers[0].name }}</a>
                            <span v-if="actie.organizers.length > 1">
                                <span>&nbsp;{{__('general.and')}}&nbsp;</span>
                                <span class="font-medium">{{actie.organizers.length - 1}} {{(actie.organizers.length - 1 > 1)? __('general.others') : __('general.other')}}</span>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </a>
    </article>
</template>

<script setup lang="ts">
    import LogoIcon from '&/logo-icon.svg'
    import LocationIcon from '&/location.svg'
    import { inject } from 'vue';
    const __ = inject('translate')

    const props = defineProps({
        actie: {
            type: Object,
            required: true
        }
    });

</script>

