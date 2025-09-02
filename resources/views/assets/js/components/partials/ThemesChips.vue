<template>
    <ul v-if="themes.length <= maxVisible" :class="`flex flex-wrap justify-${justify}`">
        <li v-for="theme in themes" :key="theme.id"
            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
            :style="{ backgroundColor: theme.color }">
            <span class="text-white" rel="theme">
                {{ theme.name }}
            </span>
        </li>
    </ul>
    <ul v-else :class="`flex flex-wrap justify-${justify}`">
        <li v-for="theme in themes.slice(0, maxVisible)" class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
            :style="{ backgroundColor: themes[0].color }">
            <span class="text-white" rel="theme">
                {{ theme.name }}
            </span>
        </li>
        <li
            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded">
            <span class="text-gray-800" rel="theme">
                +{{ themes.length - maxVisible }}{{ showPlusLabel ? " thema's" : "" }}
            </span>
        </li>
    </ul>
</template>

<script>
export default {
    name: 'ThemesChips',
    props: {
        themes: {
            type: Array,
            default: () => [],
        },
        maxVisible: {
            type: Number,
            default: 2,
        },
        showPlusLabel: {
            type: Boolean,
            default: true,
        },
        justify: {
            type: String,
            default: 'start',
        },
    },
};
</script>
