<template>
    <a :href="route" @click="clickOrganizer" :title="titleText">
        <div id="wrapper" 
            class="content flex justify-between items-center border border-gray-200 mb-1 rounded-lg shadow-md hover:shadow-lg" 
            :class="{
                'hover:bg-gray-100': mode !== 'remove', 
                'hover:bg-red-100': mode === 'remove',
                selected: selected && mode === 'select',
                small: type === 'small',
                large: type === 'large'
            }"
            :title="organizer.name">
            <div class="flex w-full space-x-3 justify-start items-center">
                <img v-if="organizer.linked_image" class="rounded-full" 
                    :class="{small: type === 'small', large: type === 'large'}" 
                    :src="organizer.linked_image.url" :title="organizer.name"
                >
                <div v-else 
                    class="organizer-image flex items-center justify-center rounded-full bg-gray-500 text-white"
                    :class="{
                        small: type === 'small',
                        large: type === 'large'
                    }"
                >
                    {{ organizer.name.charAt(0) }}
                </div>
                <div class="flex flex-1 flex-col overflow-hidden">
                    <p class="font-bold truncate">{{ organizer.name }}</p>
                    <p v-if="type === 'large'" class="text-sm line-clamp-2" v-html="organizer.description"></p>
                    <ul v-else-if="type === 'small' && showThemes" class="sm:hidden pt-2 flex space-x-1">
                        <li
                            v-for="theme in organizer.themes"
                            :key="theme.id"
                            class="relative self-start inline-block px-2 py-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                            :style="{backgroundColor: theme.color}"
                        >
                            <span class="text-white" rel="theme">
                                {{ theme.name }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-if="showThemes" class="flex justify-end items-center">
                <ul class="hidden p-2 sm:flex space-x-1">
                    <li
                        v-for="theme in organizer.themes"
                        :key="theme.id"
                        class="relative self-start inline-block px-2 py-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                        :style="{backgroundColor: theme.color}"
                    >
                        <span class="text-white" :class="{'whitespace-nowrap': type === 'large'}" rel="theme">
                            {{ theme.name }}
                        </span>
                    </li>
                </ul>
            </div>
            <div v-if="mode == 'select' && selected" class="flex justify-end items-center">
                <CheckIcon class="shrink-0" style="stroke: currentColor; width: 26px; height: 24px;" />
            </div>
            <div v-else-if="mode == 'remove'" @click="toggleSelect" class="flex justify-center items-center cursor-pointer rounded-full w-8 h-8 bg-gray-100 hover:bg-gray-200">
                <DeleteIcon class="shrink-0" style="stroke: currentColor; width: 24px; height: 24px;" />
            </div>
        </div>
    </a>
</template>

<script setup lang="ts">
    import { computed, ref, watch } from 'vue'
    import CheckIcon from '&/clarity-check-line.svg'
    import DeleteIcon from '&/antdesign-delete-o.svg'
    const emit = defineEmits(['update:modelValue'])
    import _ from 'lodash'
	const __ = str => _.get(window.i18n, str)

    const props = defineProps({
        organizer: {
            type: Object,
            required: true,
        },
        route: {
            type: String,
            default: ''
        },
        showThemes: {
            type: Boolean, 
            default: true,
        },
        mode: {
            type: String,
            default: 'list',
        },
        type: {
            type: String,
            default: 'small',
        },
        selectedInitial: {
            type: Boolean, 
            default: false,
        }
    })

    const selected = ref(props.selectedInitial)

    const titleText = computed(() => {
        return props.mode === 'remove' ? __('general.delete') : ''
    })

    const clickOrganizer = (e) => {
        if (['select', 'remove'].includes(props.mode)) {
            e.preventDefault()
            toggleSelect()
        }
    }

    const toggleSelect = () => {
        selected.value = !selected.value
        emit('update:modelValue', selected.value)
    }
    
    watch(() => props.selectedInitial, (newVal) => {
        selected.value = newVal
    })
</script>
<style lang="scss" scoped>
    #wrapper {
        &.selected {
            @apply text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700;
        }
        &.small {
            @apply h-full p-3 truncate
        }
        &.large {
            @apply p-5
        }
    }

    .organizer-image {
        &.small {
            @apply text-xl w-10 h-10
        }
        &.large {
            @apply text-3xl w-16 h-16
        }
    }
</style>

