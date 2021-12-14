<template>
    <div class="relative mx-auto xl:px-5 max-w-7xl">
        <div class="absolute inset-0">
            <div class="bg-white h-1/3 sm:h-2/3"></div>
        </div>
        <div class="relative mx-auto max-w-7xl">
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
                searchQuery: 'klimaat',
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
                    actie.body = (newBody.length > 200)? newBody.substring(0,80) + '...' : newBody.substring(0,80);
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
                axios.get(this.routes['wave.acties.search'].uri, {
                    params: {
                        q: this.searchQuery
                    }
                }).then((response) => {
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

