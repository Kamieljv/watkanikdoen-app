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
            <div class="content flex flex-col h-full">
                <div class="flex-shrink-0" style="position:relative;">
                    <img v-if="actie.linked_image" class="object-cover w-full h-[150px]" :src="actie.linked_image.url" alt="">
                    <div v-else class="h-[150px] bg-gray-300 text-gray-400 flex items-center justify-center">
                        <svg-vue icon="logo-icon" style="fill: currentColor; height: 80px;"></svg-vue>
                    </div>
                    <ul class="themes-container p-2 absolute top-0 w-full">
                        <li
                            v-for="theme in actie.themes"
                            :key="theme.id"
                            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                            :style="{backgroundColor: theme.color}"
                        >
                            <span class="text-white" rel="theme">
                                {{ theme.name }}
                            </span>
                        </li>
                    </ul>
                    <div class="distance-container text-left p-2 absolute bottom-0 w-full">
                        <div
                            v-if="actie.distance"
                            class="relative self-start inline-block bg-[color:#8a8a8a7d] px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                        >
                            <span class="flex items-center text-white" rel="theme">
                                <svg-vue icon="location" style="fill: currentColor; width: 14px; height: 14px;"></svg-vue>
                                &nbsp; {{ actie.distance + ' km' }}<br/>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-between flex-1 bg-white">
                    <div class="title-body-container p-3 h-[110px] overflow-hidden relative">
                        <h3 class="truncate uppercase text-xl font-semibold leading-7 text-gray-900">
                            {{ actie.title }}
                        </h3>
                        <p class="mt-1 line-clamp-3 text-sm text-gray-500">
                            {{ actie.body }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-col grow justify-between flex-1 bg-white">
                    <div class="details-container text-sm text-gray-500 p-3">
                        <div class="flex items-center mb-1 text-sm leading-5 text-gray-700">
                            <svg-vue icon="antdesign-clock-circle-o" class="shrink-0" style="stroke: currentColor; height: 20px;"></svg-vue>
                            &nbsp; <span class="font-medium">{{ actie.start }}</span><br/>
                        </div>
                        <div class="flex items-center text-sm leading-5 text-gray-700">
                            <svg-vue icon="antdesign-environment-o" class="shrink-0" style="stroke: currentColor; height: 20px;"></svg-vue>
                            &nbsp; <span class="font-medium truncate">{{ actie.location_human }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center p-3 bg-gray-200">
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
                            <a :href="actie.organizers[0].link" class="font-medium hover:underline">
                                {{ actie.organizers[0].name }}</a>
                            <span v-if="actie.organizers.length > 1"> {{__('general.and')}} <span class="font-medium">{{actie.organizers.length - 1}} {{(actie.organizers.length - 1 > 1)? __('general.others') : __('general.other')}}</span></span>
                        </p>
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
			return this.actie.start_unix < Math.floor(new Date().getTime() / 1000)
		}
	}
}
</script>

