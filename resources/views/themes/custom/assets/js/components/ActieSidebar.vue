<template>
    <div class="content flex flex-col gap-4 h-full">
        <!-- Image and tags -->
        <div class="flex-shrink-0 not-prose rounded-lg shadow-lg overflow-hidden" style="position:relative;">
            <img class="object-cover w-full h-48" :src="actie.image_path" alt="">
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
        <!-- Details -->
        <div class="not-prose p-3 bg-white rounded-lg shadow-lg overflow-hidden">
            <h3>{{ __("acties.details") }}</h3>
            <div class="details-container text-sm text-gray-500">
                <div class="time">
                    <i class="far fa-calendar"></i> &nbsp; {{ actie.start }}<br/>
                </div>
                <div class="location">
                    <i class="fas fa-map-marker-alt"></i> &nbsp; {{ actie.location_human }}
                </div>
            </div>
        </div>
        <!-- Buttons -->
        <div>
            <button :href="actie.link" class="w-full inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-[color:var(--wkid-pink)] hover:bg-[color:var(--wkid-pink-dark)] focus:outline-none focus:border-indigo-700 focus:shadow-outline-wave active:bg-blue-700">
                <i class="fas fa-link"></i> &nbsp; {{ __("acties.to_organizer") }}
            </button>
        </div>
        <!-- About the organizer -->
        <div class="not-prose p-3 bg-white rounded-lg shadow-lg overflow-hidden">
            <h3>{{ __("acties.about_organizer") }}</h3>
            <div class="flex flex-row items-center">
                <div class="flex-shrink-0">
                    <a href="#">
                        <img class="w-10 h-10 rounded-full" :src="actie.user.avatar_path" alt="">
                    </a>
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 text-gray-900">
                        <a href="#" class="font-medium">{{ actie.user.name }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ActieAgenda',
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

