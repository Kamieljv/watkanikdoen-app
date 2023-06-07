<template>
    <a :href="route" @click="clickOrganizer" :title="titleText">
        <div id="wrapper" 
            class="content flex p-5 justify-between items-center border border-gray-200 mb-1 rounded-lg shadow-md hover:shadow-lg" 
            :class="{
                'hover:bg-gray-100': mode !== 'remove', 
                'hover:bg-red-100': mode === 'remove',
                'selected': selected && mode === 'select'
            }"
            :title="organizer.name">
            <div class="flex w-full space-x-3 justify-start items-stretch" style="min-width: 0">
                <img v-if="organizer.linked_image" class="w-16 h-16 rounded-full" :src="organizer.linked_image.url" :title="organizer.name">
                <div v-else class="flex items-center justify-center text-3xl w-16 h-16 rounded-full bg-gray-500 text-white">
                    {{ organizer.name.charAt(0) }}
                </div>
                <div class="flex flex-1 flex-col overflow-hidden">
                    <p class="font-bold truncate">{{ organizer.name }}</p>
                    <p class="text-sm line-clamp-2" v-html="organizer.description"></p>
                </div>
            </div>
            <div v-if="showThemes" class="flex justify-end items-center">
                <ul class="flex p-2 space-x-1">
                    <li
                        v-for="theme in organizer.themes"
                        :key="theme.id"
                        class="relative self-start inline-block px-2 py-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                        :style="{backgroundColor: theme.color}"
                    >
                        <span class="text-white whitespace-nowrap" rel="theme">
                            {{ theme.name }}
                        </span>
                    </li>
                </ul>
            </div>
            <div v-if="mode == 'select' && selected" class="flex justify-end items-center">
                <svg-vue icon="clarity-check-line" class="shrink-0" style="stroke: currentColor; width: 26px; height: 24px;"></svg-vue>
            </div>
            <div v-else-if="mode == 'remove'" @click="toggleSelect" class="flex justify-center items-center cursor-pointer rounded-full w-8 h-8 bg-gray-100 hover:bg-gray-200">
                <svg-vue icon="antdesign-delete-o" class="shrink-0" style="stroke: currentColor; width: 24px; height: 24px;"></svg-vue>
            </div>
        </div>
    </a>
</template>

<script>
export default {
	name: "Organizer",
	props: {
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
        selectedInitial: {
            type: Boolean, 
            default: false,
        },
	},
    data() {
        return {
            selected: this.selectedInitial
        }
    },
    computed: {
        titleText: function() {
            return this.mode === 'remove' ? this.__('general.delete') : ''
        }
    },
    watch: {
        selectedInitial: function() {
            this.selected = this.selectedInitial
        }
    },
    methods: {
        clickOrganizer(e) {
            if (['select', 'remove'].includes(this.mode)) {
                e.preventDefault()
                this.toggleSelect()
            }
        },
        toggleSelect() {
            this.selected = !this.selected
            this.$emit('input', this.selected)
        },
    }
}
</script>
<style lang="scss" scoped>
    #wrapper.selected {
        @apply text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 active:bg-blue-700;
    }
</style>

