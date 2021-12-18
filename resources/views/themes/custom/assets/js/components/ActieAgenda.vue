<template>
    <div class="row">
        <div id="filter-search-banner" class="h-[400px] bg-gradient-to-br from-[var(--wkid-red)] to-[var(--wkid-blue)] flex items-center justify-center">
            <div id="filter-search-container" class="w-[500px] flex flex-wrap">
                <div id="search-container" class="row h-[50px] w-full">
                    <div id="search-wrapper" class="col h-full w-full rounded-full bg-white px-[22px]">
                        <form-field
                            x-cloak
                            type="text"
                            placeholder="Zoeken..."
                            classes="h-full w-full p-0 border-none focus:ring-0 focus:filter-none"
                            :autofocus="true"
                            @input="processQuery"
                        />
                    </div>
                </div>
                <div id="filter-container" class="row h-[50px] w-[500px] mt-1">
                    <div id="filter-wrapper" class="col grid gap-3 grid-cols-3">
                        <t-rich-select 
                            id="category-selector"
                            :options="categories"
                            textAttribute="name"
                            v-model="categoriesSelected"
                            :multiple="true"
                            :clearable="true"
                            :hideSearchBox="true"
                            placeholder="Categorie..."
                        />
                        <t-rich-select :options="categories" class="rounded-full "/>
                        <t-rich-select :options="categories" class="rounded-full "/>
                    </div>
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
            categories: {
                type: Array,
                required: true,
            }
        },
        data() {
            return {
                acties: [],
                isGeladen: true,
                heeftFout: false,
                query: '',
                categoriesSelected: '',
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
            categoriesSelected: function(newVal) {
                this.getActies();
            }
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
                        q: this.query,
                        categories: this.categoriesSelected,
                    }
                }).then((response) => {
                    this.acties = response.data.acties.data;
                }).catch((error) => {
                    this.heeftFout = true;
                }).finally(() => {
                    this.isGeladen = true;
                });
            },
            processQuery: _.debounce(function(input) {
                    this.query = input;
                }, 500),
        }
    }
</script>

<style lang="scss" scoped>
    
</style>

