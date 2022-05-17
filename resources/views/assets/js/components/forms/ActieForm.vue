<template>
    <ValidationObserver ref="validator">
        <div class="grid grid-cols-1 md:grid-cols-3 max-w-4xl mx-auto flex-col my-6 md:divide-x">
            <div class="col-span-2 space-y-3">
                <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border-gray-150">
                    <div class="flex flex-col mt-5 md:pr-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Titel & teksten
                        </h3>
                        <p class="text-sm leading-5 text-gray-500">
                            Omschrijf de actie zo goed als je kunt. Gebruik daarbij vooral ook teksten van de organisator, zolang je vermeldt waar deze vandaan komen.
                        </p>
                    </div>
                    <div class="flex flex-col mt-5 md:pr-5 space-y-3">
                        <!-- Title -->
                        <FormField
                            v-model="report.title"
                            label="Titel"
                            name="title"
                            type="text"
                            :rules="{max: 50}"
                            required
                        />
                        <!-- Body -->
                        <div class="min-h-[200px]">
                            <label for="body" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("reports.body") }}
                            </label>
                            <rich-text-field
                                name="body"
                                v-model="report.body"
                            />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-start flex-1 md:pr-5 overflow-hidden bg-white border-gray-150">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Locatie
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Waar zal de actie plaatsvinden?
                    </p>
                    <div class="flex flex-col mt-5 space-y-3">
                        <!-- Location Human -->
                        <FormField
                            v-model="report.location_human"
                            label="Locatie (tekst om weer te geven)"
                            name="location_human"
                            type="text"
                            :rules="{max: 80}"
                            required
                        />
                        <div>
                            <label for="location" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __("reports.location") }}
                            </label>
                            
                            <div class="mt-1 rounded-md shadow-sm overflow-hidden">
                                <coordinates-form-field
                                    :default-center="defaultCenter"
                                    :zoom="zoom"
                                    fieldname="location"
                                    :frontend="true"
                                    :unedited="!('center' in report)"
                                    v-model="report.center"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-1 space-y-3">
                <div class="flex flex-col justify-start flex-1 md:pl-5 bg-white border-gray-150">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Link naar de organisatiepagina
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Waar kunnen bezoekers meer informatie over deze actie vinden?
                    </p>
                    <div class="flex flex-col mt-5 space-y-3">
                        <!-- Externe link -->
                        <FormField
                            v-model="report.externe_link"
                            label="Externe link"
                            name="location_human"
                            type="url"
                            rules="url"
                            required
                        />
                    </div>
                </div>
                <div class="flex flex-col justify-start flex-1 mb-5 md:pl-5 overflow-hidden bg-white border-gray-150">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Datum & tijd
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Wanneer begint en eindigt de actie?
                    </p>
                    <div class="flex flex-col mt-5 space-y-3">
                        <!-- Time start -->
                        <FormField
                            v-model="report.time_start"
                            label="Begin van de actie"
                            name="Begintijd"
                            type="datetime-local"
                            rules="afterToday"
                            required
                        />
                        <!-- Time end -->
                        <FormField
                            v-model="report.time_end"
                            label="Eind van de actie"
                            name="time_end"
                            type="datetime-local"
                            required
                            rules="after:@Begintijd"
                        />
                    </div>
                </div>
                <div class="flex flex-col justify-start flex-1 mb-5 md:pl-5 overflow-hidden bg-white border-gray-150">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Afbeelding
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Kies een afbeelding die bij de actie past.
                    </p>
                    <div class="flex flex-col mt-5 space-y-3">
                        <!-- Image -->
                        <form-image
                            v-model="report.image"
                            field-name="image"
                            viewport-type="square"
                            default-color="var(--wkid-blue-light)"
                            :width="1000"
                        />
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
        defaultCenter: {
			type: Array,
			required: true,
		},
		zoom: {
			type: Number,
			required: true,
		},
        report: {
            type: Object,
            required: true
        }
    },
    data() {
		return {
            //
        }
	},
    watch: {
        report: function(value) {
            this.$emit('input', value)
        }
    },
}
</script>

