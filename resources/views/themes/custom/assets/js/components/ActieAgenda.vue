<template>
    <div class="row">
        <div id="search-banner" class="h-[400px] bg-gradient-to-br from-[var(--wkid-red)] to-[var(--wkid-blue)] flex items-center justify-center">
            <div id="search-container" class="h-[50px] w-[500px]">
                <div id="search-wrapper" class="h-full w-full rounded-full bg-white px-[22px]">
                    <form-field
                        x-cloak
                        type="text"
                        placeholder="Zoeken..."
                        classes="h-full w-full p-0 border-none focus:ring-0 focus:filter-none"
                        @input="processInput"
                    />
                </div>
            </div>
        </div>

        <div class="row px-8 mx-auto xl:px-5 max-w-6xl" >
            <div class="col" style="width: 100%">
                <div class="relative mx-auto xl:px-5 max-w-7xl">
                    <div class="absolute inset-0">
                        <div class="bg-white h-1/3 sm:h-2/3"></div>
                    </div>
                    <div class="relative mx-auto max-w-7xl">
                        <div 
                            class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                            v-if="!isGeladen"
                        >                                
                            <t-card
                                v-for="i in skeletonArray"
                                :key="i"
                                variant="skeleton"
                                class="rounded-lg shadow-md overflow-hidden"
                            >
                                <template v-slot:header>
                                    <div class="h-6 w-20 inline-block bg-gray-100 rounded"/>
                                </template>
                                <div class="relative h-6 w-full inline-block bg-gray-200 rounded"></div>
                                <div class="relative h-3 w-full inline-block bg-gray-200 rounded"></div>

                                <template v-slot:footer >
                                    <div class="rounded-full bg-gray-200 h-10 w-10"></div>
                                </template>
                            </t-card>
                        </div><div 
                            v-else
                            class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                        >
                            <actie
                                v-for="actie in actiesFormatted"
                                :key="actie.id"
                                :actie="actie"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components: {},
        name: 'ActieAgenda',
        props: {
            routes: {
                type: Object,
                required: true,
            },
            query: {
                type: String,
                default: '',
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
            skeletonArray() {
                return [...Array(10).keys()];
            },
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
            query: function(newVal) {
                this.getActies();
            },
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
                        q: this.query
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
            processInput: _.debounce(function(input) {
                    this.query = input;
                }, 500),
        }
    }
</script>

<style lang="scss" scoped>
    
</style>

