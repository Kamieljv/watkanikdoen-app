<template>
    <div>
        <div class="row">
            <div id="filter-search-banner" class="h-[200px] bg-gradient-to-br from-[var(--wkid-red)] to-[var(--wkid-blue)] flex items-bottom pb-[50px] justify-center">
                
            </div>
        </div>
        <div class="row px-8 mx-auto xl:px-5 max-w-6xl">
            <div id="filter-container" class="row my-3">
                <div id="filter-wrapper" class="col grid gap-3 grid-cols-4">
                    <div>
                        <t-input
                            type="text"
                            placeholder="Zoeken..."
                            :autofocus="true"
                            @input="processQuery"
                        />
                    </div>
                    <t-rich-select 
                        id="category-selector"
                        :options="themes"
                        textAttribute="name"
                        v-model="themesSelected"
                        :multiple="true"
                        :hideSearchBox="true"
                        :closeOnSelect="false"
                        placeholder="Theme..."
                    />
                    <form-autocomplete
                        :items="geoSuggestions"
                        :isAsync="true"
                        @change="getGeoSuggestions"
                        @input="getCoordinates"
                        placeholder="Plaatsnaam"
                    />
                    <form-slider
                        thumbColor="var(--wkid-blue)"
                        progressColor="var(--wkid-blue)"
                        unit="km"
                        :min="10"
                        :max="150"
                        v-model="distance"
                        :currentValue="distance"
                        :delay="400"
                        :disabled="coordinates !== ''"
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
                        </div>
                        <div 
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
            themes: {
                type: Array,
                required: true,
            }
        },
        data() {
            return {
                acties: [],
                themesSelected: '',
                query: '',
                coordinates: '',
                distance: 100,
                geoSuggestions: [],
                isGeladen: true,
                heeftFout: false,
            }
        },
        computed: {
            sliderArray() {
                return [...Array(10+1).keys()].slice(1).map((v) => {return v * stepSize})
            },
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
            query: function() {
                this.getActies();
            },
            themesSelected: function() {
                this.getActies();
            },
            distance: function(newVal) {
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
                        q: this.query,
                        themes: this.themesSelected,
                        coordinates: this.coordinates,
                        distance: this.distance,
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
            async getGeoSuggestions(query) {
                axios.get('https://geodata.nationaalgeoregister.nl/locatieserver/v3/suggest', {
                    params: {
                        q: query,
                        rows: 5,
                        fl: "id,weergavenaam",
                        fq: "type:woonplaats",
                    }
                }).then((data) => {
                    this.geoSuggestions = Object.keys(data.data.highlighting).map((key) => {
                        return {
                            id: key,
                            name: data.data.highlighting[key].suggest[0]
                        }
                    });
                });
            },
            async getCoordinates(obj) {
                if (obj !== '') { 
                    axios.get('https://geodata.nationaalgeoregister.nl/locatieserver/v3/lookup', {
                        params: {
                            id: obj.id,
                            rows: 1,
                        }
                    }).then((data) => {
                        let pointString = data.data.response.docs[0].centroide_ll;
                        this.coordinates = pointString.slice(6,pointString.length-1).split(" ").reverse().join(",")
                        this.getActies();
                    });
                } else {
                    this.coordinates = '';
                    this.getActies();
                }
            }
        }
    }
</script>

