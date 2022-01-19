<template>
    <article
        class="flex flex-col overflow-hidden rounded-lg shadow-lg actie relative transition-all ease-out hover:translate-y-[-0.250rem] hover:shadow-[0_0_20px_rgba(0,0,0,0.30)]"
        typeof="Article"
    >
        <a :href="actie.link" class="h-full">
            <meta property="name" :content="actie.title">
            <meta property="author" typeof="Person" content="admin">
            <meta property="dateModified" :content="new Date(actie.updated_at).toISOString()">
            <meta class="uk-margin-remove-adjacent" property="datePublished" :content="new Date(actie.created_at).toISOString()">
            <div class="content flex flex-col h-full">
                <div class="flex-shrink-0" style="position:relative;">
                    <img v-if="actie.image_path" class="object-cover w-full h-[150px]" :src="actie.image_path" alt="">
                    <div v-else class="h-[150px] bg-gradient-to-br from-[var(--wkid-red-light)] to-[var(--wkid-blue-light)] text-white flex items-center justify-center">
                        <svg-vue icon="logo" style="stroke: currentColor; height: 52px;"></svg-vue>
                    </div>
                    <ul class="themes-container p-2 absolute top-0 w-full">
                        <li
                            v-for="theme in actie.themes"
                            :key="theme.id"
                            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                        >
                            <span class="text-gray-700" rel="theme">
                                {{ theme.name }}
                            </span>
                        </li>
                    </ul>
                    <div class="distance-container text-right p-2 absolute bottom-0 w-full">
                        <div
                            v-if="actie.distance"
                            class="relative self-start inline-block bg-[color:var(--wkid-yellow-light)] px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded"
                        >
                            <span class="text-white" rel="theme">
                                <i class="fas fa-location-arrow"></i> &nbsp; {{ actie.distance + ' km' }}<br/>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-between flex-1 bg-white">
                    <div class="title-body-container p-3 h-[110px] overflow-hidden relative">
                        <h3 class="truncate text-xl font-semibold leading-7 text-gray-900">
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
                        <a href="#">
                            <img class="w-10 h-10 rounded-full" :src="actie.organizers[0].logo_path" alt="">
                        </a>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 text-gray-900">
                            {{ __("acties.organized_by") }}
                            <a :href="actie.organizers[0].link" class="font-medium hover:underline">
                                {{ actie.organizers[0].name }}</a>
                            <span v-if="actie.organizers.length > 1"> {{__('general.and')}} {{actie.organizers.length - 1}} {{(actie.organizers.length - 1 > 1)? __('general.others') : __('general.other')}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </a>
    </article>
</template>

<script>
export default {
	name: "ActieAgenda",
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

</style>

