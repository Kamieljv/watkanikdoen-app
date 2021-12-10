<template>
    <div class="relative px-8 pt-8 pb-20 mx-auto xl:px-5 max-w-7xl sm:px-6 lg:pt-10 lg:pb-28">
        <div class="absolute inset-0">
            <div class="bg-white h-1/3 sm:h-2/3"></div>
        </div>
        <div class="relative mx-auto max-w-7xl">
            <div class="flex flex-col justify-start">
                <h1 class="text-3xl font-extrabold leading-9 tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                    {{ __("acties.title") }}
                </h1>
                <p class="mt-3 text-xl leading-7 text-gray-500 sm:mt-4">
                    {{ __("acties.subtitle") }}
                </p>
            </div>
            Geladen: {{ isGeladen }}
            <div class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3">
                <article 
                    v-for="actie in acties"
                    :key="actie.id"
                    class="flex flex-col overflow-hidden rounded-lg shadow-lg" 
                    typeof="Article"
                >
                    <!-- <meta property="name" content="{{ $actie->title }}">
                    <meta property="author" typeof="Person" content="admin">
                    <meta property="dateModified" content="{{ Carbon\Carbon::parse($actie->updated_at)->toIso8601String() }}">
                    <meta class="uk-margin-remove-adjacent" property="datePublished" content="{{ Carbon\Carbon::parse($actie->created_at)->toIso8601String() }}">

                    <div class="flex-shrink-0">
                        <a href="{{ $actie->link() }}">
                            <img class="object-cover w-full h-48" src="{{ $actie->image() }}" alt="">
                        </a>
                    </div>
                    <div class="relative flex flex-col justify-between flex-1 p-6 bg-white">
                        <div class="flex-1">
                            <a href="{{ $actie->link() }}" class="block">
                                <h3 class="mt-2 text-xl font-semibold leading-7 text-gray-900">
                                    {{ $actie->title }}
                                </h3>
                            </a>
                            <a href="{{ $actie->link() }}" class="block">
                                <p class="mt-3 text-base leading-6 text-gray-500">
                                    {{ substr(strip_tags($actie->body), 0, 200) }}@if(strlen(strip_tags($actie->body)) > 200){{ '...' }}@endif
                                </p>
                            </a>
                        </div>
                        @foreach ($actie->categories as $category)
                            <p class="relative self-start inline-block px-2 py-1 mt-4 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded">
                                <a href="{{ route('wave.blog.category', $category->slug) }}" class="text-gray-700 hover:underline" rel="category">
                                    {{ $category->name }}
                                </a>
                            </p>
                        @endforeach
                    </div>

                    <div class="flex items-center p-6 bg-gray-50">
                            <div class="flex-shrink-0">
                                <a href="#">
                                    <img class="w-10 h-10 rounded-full" src="{{ $actie->user->avatar() }}" alt="">
                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium leading-5 text-gray-900">
                                    {{ __("acties.written_by") }}<a href="#" class="hover:underline">{{ $actie->user->name }}</a>
                                </p>
                                <div class="flex text-sm leading-5 text-gray-500">
                                {{ __("general.on") }} <time datetime="{{ Carbon\Carbon::parse($actie->created_at)->toIso8601String() }}" class="ml-1">{{ Date::parse($actie->created_at)->format("j F Y") }}</time>
                                </div>
                            </div>
                        </div> -->

                </article>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ActieAgenda',
        props: {
            routes: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                acties: [],
                isGeladen: true,
                heeftFout: false,
            }
        },
        computed: {
            heeftActies() {
                return (this.acties.length > 0);
            },
        },
        watch: {
            // var: function(newVal) {
            // this.getActies();
            // },
        },
        mounted() {
            this.getActies();
        },
        methods: {
            async getActies() {
                this.isGeladen = false;
                this.heeftFout = false;
                axios.get(this.routes['wave.acties'].uri).then((response) => {
                    this.acties = response.data.acties;
                    this.categories = response.data.categories;
                }).catch((error) => {
                    this.heeftFout = true;
                }).finally(() => {
                    this.isGeladen = true;
                });
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>

