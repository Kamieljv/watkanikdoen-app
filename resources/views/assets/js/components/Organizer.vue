<template>
    <a :href="route">
        <div class="content flex h-full p-3 justify-between border border-gray-200 mb-1 rounded-lg shadow-md hover:shadow-lg hover:bg-gray-100">
            <div class="flex space-x-3 justify-start items-center">
                <img v-if="organizer.linked_image" class="w-10 h-10 rounded-full" :src="organizer.linked_image.url" :title="organizer.name">
                <div v-else class="flex items-center justify-center text-xl w-10 h-10 rounded-full bg-gray-500 text-white">
                    {{ organizer.name.charAt(0) }}
                </div>
                <div class="flex flex-col overflow-hidden">
                    <p class="font-bold truncate">{{ organizer.name }}</p>
                    <ul class="sm:hidden pt-2 flex space-x-1">
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
            <div class="flex justify-end items-center">
                <ul class="hidden p-2 sm:flex space-x-1">
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
			required: true,
		}
	},
}
</script>

