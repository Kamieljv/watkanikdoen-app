<template>
    <ValidationObserver ref="organizerValidator">
        <p class="text-body leading-5 text-gray-500 mt">
            Wie is de organisator van je actie? Kies één of meerdere organisatoren uit de lijst. 
            Kun je de juiste organisator niet vinden? Dan kun je deze zelf toevoegen met het formulier.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-5 max-w-4xl mx-auto flex-col my-6 md:divide-x">
            <div class="col-span-2 space-y-3">
                <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border-gray-150">
                    <div class="flex flex-col mt-5 md:pr-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Kies een organisator uit onze lijst
                        </h3>
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Gebruik de zoekfunctie om de organisator te vinden.
                        </p>
                    </div>
                    <div class="flex flex-col mt-5 md:pr-5">
                        <!-- Organizers -->
                        <Organizers
                            v-model="organizersSelected"
                            :organizers-selected="organizersSelected"
                            :routes="routes"
                            :show-themes="false"
                            :show-pagination="false"
                            :max="5"
                            mode="select"
                        />
                    </div>
                </div>
            </div>
            <div class="col-span-3 space-y-3">
                <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border-gray-150">
                    <div class="flex flex-col mt-5 md:pl-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Of voeg de organisator zelf toe
                        </h3>
                        <p class="text-sm leading-5 text-gray-500 mt">
                            Omschrijf de organisator. Gebruik daarbij eventueel teksten van deze organisator, zolang je vermeldt waar deze vandaan komen.
                        </p>
                    </div>
                    <div class="flex flex-col mt-5 md:pl-5">
                        <!-- Name -->
                        <FormField
                            v-model="name"
                            label="Naam"
                            name="naam"
                            type="text"
                            rules="required|max:80"
                            validation-mode="lazy"
                        />
                        <!-- Body -->
                        <div class="min-h-[200px] mt-3">
                            <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("organizers.description") }}
                            </label>
                            <rich-text-field
                                name="description"
                                :value="description"
                                v-model="description"
                                ref="description"
                            />
                        </div>
                        <!-- Website -->
                        <FormField
                            v-model="website"
                            label="Website"
                            name="website"
                            type="url"
                            rules="required|url"
                        />
                        <div class="flex mt-5 justify-end">
                            <a @click="addOrganizer" class="primary add-button">
                                <svg-vue icon="clarity-add-line" class="shrink-0" style="stroke: currentColor;"></svg-vue>
                                {{ __('general.add') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-4xl mx-auto flex-col my-6">
            <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border-gray-150">
                <div class="flex flex-col mt-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Geselecteerde Organisatoren
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Klik op een organisator om uit de selectie te verwijderen.
                    </p>
                    <hr class="mt-2"/>
                </div>
                <div v-if="organizersSelected.length > 0" class="flex flex-col mt-5">
                    <organizer
                        v-for="organizer in organizersSelected"
                        :key="organizer.name"
                        :organizer="organizer"
                        :show-themes="false"
                        :disabled="true"
                        mode="remove"
                        @input="removeSelected($event, organizer)"
                    />
                </div>
                <div v-else class="flex flex-col mt-5">
                    <div class="text-gray-400">
                        <h5>{{__('organizers.none_selected')}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </ValidationObserver>
</template>

<script>

import { ValidationObserver } from 'vee-validate';
import { ValidationProvider } from 'vee-validate';
import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "Actie",
    components: {
        ValidationProvider,
        ValidationObserver,
    },
    mixins: [
        caseHelper,
    ],
    props: {
        routes: {
            type: Object,
            required: true,
        },
        selectedOrganizers: {
            type: Array,
            default: () => [],
        }
    },
    data() {
		return {
            name: '',
            description: '',
            website: '',
            organizersSelected: [],
        }
	},
    methods: {
        addOrganizer: function() {
            this.$refs.organizerValidator.validate().then((result) => {
                if (result) {
                    this.organizersSelected.push({
                        name: this.name, 
                        description: this.description, 
                        website: this.website
                    })
                    this.$refs.organizerValidator.reset()
                    this.resetForm()
                }
            })           
        },
        resetForm: function() {
            this.name = this.description = this.website = ''
            this.$refs.description.editor.commands.clearContent()
        },
        removeSelected: function(e, organizer) {
            this.organizersSelected = this.organizersSelected.filter((v) => {
                if (!('id' in organizer)) {
                    return v.name !== organizer.name
                }
                return v.id !== organizer.id
            })
        }
    },
    mounted() {
        this.organizersSelected = this.selectedOrganizers.length > 0 ? this.selectedOrganizers : []
    },
    watch: {
        organizersSelected: function(value) {
            this.$emit('input', this.organizersSelected)
        }
    }
}
</script>

<style lang="scss" scoped>
    .add-button {
        @apply bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 active:bg-green-700;

        & svg {
            height: 20px;
            width: 17px;
            margin-right: 5px;
        }
    }
</style>
