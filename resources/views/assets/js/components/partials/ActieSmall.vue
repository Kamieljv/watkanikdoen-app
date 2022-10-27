<template>
    <article
        class="flex flex-col overflow-hidden rounded-lg shadow-lg actie relative transition-all ease-out hover:translate-y-[-0.250rem] hover:shadow-[0_0_20px_rgba(0,0,0,0.30)]"
        typeof="Article"
    >
        <a :href="actie.link" class="h-full" :class="{'opacity-70 grayscale': isAfgelopen}" :title="isAfgelopen ? 'Deze actie is afgelopen' : actie.title ">
            <meta property="name" :content="actie.title">
            <meta property="author" typeof="Person" content="admin">
            <meta property="dateModified" :content="new Date(actie.updated_at).toISOString()">
            <meta class="uk-margin-remove-adjacent" property="datePublished" :content="new Date(actie.created_at).toISOString()">
            <div class="content flex flex-row h-full">
                <div class="flex-shrink-0 relative hidden lg:block">
                    <img v-if="actie.linked_image" class="object-cover h-full" :src="actie.linked_image.url" alt="">
                    <div v-else class="h-full bg-gray-300 text-gray-400 flex items-center justify-center">
                        <svg-vue icon="logo-icon" style="fill: currentColor; height: 80px;"></svg-vue>
                    </div>
                </div>
                <div class="flex flex-col justify-between flex-1 bg-white">
                    <div class="title-body-container p-3 h-full overflow-hidden relative">
                        <h3 class="truncate uppercase text-xl font-semibold leading-7 text-gray-900">
                            {{ actie.title }}
                        </h3>
                        <span class="text-sm font-bold text-[color:var(--wkid-pink)]">{{actie.start_end.toUpperCase()}}</span>
                        <div class="mb-2">
                            <p class="text-sm leading-5 text-gray-900">
                                {{ __("acties.by") }}
                                <a :href="actie.organizers[0].link" class="font-medium hover:underline" style="color: inherit;">
                                    {{ actie.organizers[0].name }}</a>
                                <span v-if="actie.organizers.length > 1"> {{__('general.and')}} <span class="font-medium">{{actie.organizers.length - 1}} {{(actie.organizers.length - 1 > 1)? __('general.others') : __('general.other')}}</span></span>
                            </p>
                        </div>
                        <div>
                            <ul
                                v-for="category in actie.categories"
                                :key="category.id"
                            >
                                <li
                                    class="relative self-start inline-block bg-gray-100 px-2 py-1 mr-1 mb-1 text-xs font-medium text-gray-400 uppercase bg-gray-100 rounded"
                                >
                                    <span class="flex items-center text-gray-800" rel="theme">
                                        {{ category.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <ul v-if="actie.themes.length <= 2" class="themes-container w-full">
                                <li
                                    v-for="theme in actie.themes"
                                    :key="theme.id"
                                    class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium uppercase bg-gray-100 rounded"
                                    :style="{backgroundColor: theme.color}"
                                >
                                    <span class="text-white" rel="theme">
                                        {{ theme.name }}
                                    </span>
                                </li>
                            </ul>
                            <ul v-else class="themes-container w-full">
                                <li
                                    class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium uppercase bg-gray-100 rounded"
                                    :style="{backgroundColor: actie.themes[0].color}"
                                >
                                    <span class="text-white" rel="theme">
                                        {{ actie.themes[0].name }}
                                    </span>
                                </li>
                                <li
                                    class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium uppercase bg-gray-100 rounded"
                                >
                                    <span class="text-gray-800" rel="theme">
                                        +{{ actie.themes.length - 1 }} thema's
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

<script>
export default {
	name: "Actie",
	props: {
		actie: {
			type: Object,
			required: true,
		}
	},
	computed: {
		isAfgelopen() {
			return new Date(this.actie.time_end) < new Date()
		}
	}
}
</script>

