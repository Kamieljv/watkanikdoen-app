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
            <div class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <actie
                    v-for="actie in actiesFormatted"
                    :key="actie.id"
                    :actie="actie"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import Actie from './Actie.vue';
    export default {
        components: { Actie },
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
            actiesFormatted() {
                this.acties.forEach((actie) => {
                    // filter HTML tags and take first 200 chars
                    var newBody = actie.body.replace(/(<([^>]+)>)/gi, "");
                    actie.body = (newBody.length > 200)? newBody.substring(0,200) + '...' : newBody.substring(0,200);
                    return actie
                });
                return this.acties;
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
                    this.acties = response.data.acties.data;
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

