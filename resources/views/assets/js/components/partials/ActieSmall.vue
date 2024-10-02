<template>
    <article
        class="flex flex-col overflow-hidden rounded-lg shadow-lg actie relative transition-all ease-out hover:translate-y-[-0.250rem] hover:shadow-[0_0_20px_rgba(0,0,0,0.30)]"
        typeof="Article"
    >
        <a :href="actie.link" :target="targetBlank ? '_blank' : false" class="h-full" :class="{'opacity-70 grayscale': isAfgelopen}" :title="isAfgelopen ? 'Deze actie is afgelopen' : actie.title ">
            <meta property="name" :content="actie.title">
            <meta property="author" typeof="Person" content="admin">
            <meta property="dateModified" :content="new Date(actie.updated_at).toISOString()">
            <meta class="uk-margin-remove-adjacent" property="datePublished" :content="new Date(actie.created_at).toISOString()">
            <div class="content h-full grid grid-cols-3">
                <div class="flex-shrink-0 col-span-1 relative">
                    <img v-if="actie.linked_image" class="object-cover h-full" :src="actie.linked_image.url" alt="">
                    <div v-else class="h-full bg-gray-300 text-gray-400 flex items-center justify-center">
                        <LogoIcon style="fill: currentColor; height: 80px;" />
                    </div>
                </div>
                <div class="flex flex-col col-span-2 justify-between flex-1 bg-white">
                    <div class="title-body-container p-3 h-full overflow-hidden flex flex-col justify-between">
                        <div>
                            <h3 class="line-clamp-2 uppercase text-xl font-semibold leading-5 text-gray-900">
                                {{ actie.title }}
                            </h3>
                            <span class="text-sm font-bold text-[color:var(--wkid-pink)]">{{actie.start_date.toUpperCase()}}</span>
                            <div class="mb-2">
                                <p class="text-sm leading-5 text-gray-900 line-clamp-2">
                                    {{ __("acties.by") }}
                                    <a :href="actie.organizers[0].link" class="font-medium hover:underline" style="color: inherit;">
                                        {{ actie.organizers[0].name }}</a>
                                    <span v-if="actie.organizers.length > 1"> {{__('general.and')}} <span class="font-medium">{{actie.organizers.length - 1}} {{(actie.organizers.length - 1 > 1)? __('general.others') : __('general.other')}}</span></span>
                                </p>
                            </div>
                        </div>
                        <div>
                            <ul v-if="actie.themes.length < 2" class="themes-container w-full">
                                <li
                                    v-for="theme in actie.themes"
                                    :key="theme.id"
                                    class="relative self-start inline-block px-2 py-1 mr-1 text-xs font-medium uppercase bg-gray-100 rounded"
                                    :style="{backgroundColor: theme.color}"
                                >
                                    <span class="text-white" rel="theme">
                                        {{ theme.name }}
                                    </span>
                                </li>
                            </ul>
                            <ul v-else class="themes-container w-full">
                                <li
                                    class="relative self-start inline-block px-2 py-1 mr-1 text-xs font-medium uppercase bg-gray-100 rounded"
                                    :style="{backgroundColor: actie.themes[0].color}"
                                >
                                    <span class="text-white" rel="theme">
                                        {{ actie.themes[0].name }}
                                    </span>
                                </li>
                                <li
                                    class="relative self-start inline-block px-2 py-1 mr-1 text-xs font-medium uppercase bg-gray-100 rounded"
                                >
                                    <span class="text-gray-800" rel="theme">
                                        +{{ actie.themes.length - 1 }}
                                    </span>
                                </li>
                            </ul>
                        </div>  
                    </div>
                </div>
            </div>
        </a>
    </article>
</template>

<script setup lang="ts">
    import { computed, defineProps } from 'vue'
    import LogoIcon from '&/logo-icon.svg'
    import _ from 'lodash'
    const __ = str => _.get(window.i18n, str)

    const props = defineProps({
        actie: {
            type: Object,
            required: true,
        },
        targetBlank: {
            type: Boolean,
            default: false,
        }
    })
        
    const isAfgelopen = computed(() => {
            return new Date(props.actie.end_date + " " + props.actie.end_time) < new Date()
        }
    )
    
</script>

