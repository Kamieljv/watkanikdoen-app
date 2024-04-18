<template>
    <ValidationObserver ref="actieValidator">
        <div class="grid grid-cols-1 md:grid-cols-3 max-w-4xl mx-auto flex-col my-6 md:divide-x space-y-3">
            <div class="col-span-2 space-y-3">
                <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border-gray-150">
                    <div class="flex flex-col md:pr-5">
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
                                    :unedited="!('location' in report)"
                                    v-model="report.location"
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
                            <form @submit.prevent="addActionUrl">
                                <FormField
                                    v-model="report.externe_link"
                                    name="link" label="Externe link" type="url"
                                    rules="url"
                                    >
                                    <button class="primary plus-btn" @click="addActionUrl" title="Nog een link toevoegen">
                                        <svg-vue icon="antdesign-plus-o" class="w-6 h-6 text-white" />
                                    </button>
                                </FormField>
                            </form>
                        <div>
                            <div v-for="url in actionUrls" class="flex items-center space-x-1"> 
                                <a :href="url" class="text-blue-900 hover:underline" target="_blank">{{ url }}</a> <span class="text-red-500 cursor-pointer" @click="removeActionUrl(url)"><svg-vue icon="antdesign-close" class="w-4 h-4"" /></span>
                            </div>
                            <ValidatedFormField
                                v-model="report.actionUrls"
                                name="actionUrls"
                                type="hidden"
                                :rules="{required: true}"
                            >
                                <input v-model="report.actionUrls" type="hidden" name="actionUrls" />
                            </ValidatedFormField>
                        </div>
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
                            v-model="report.start_date"
                            label="Datum begin van de actie"
                            name="BeginDatum"
                            type="date"
                            rules="afterToday"
                            required
                            @input="() => { this.report.end_date = this.report.start_date }"
                        />
                        <FormField
                            v-model="report.start_time"
                            label="Tijdstip begin van de actie"
                            name="BeginTijd"
                            type="time"
                            step="900"
                            @input="() => { this.report.end_time = addHours(this.report.start_time, 1) }"
                        />
                        <!-- Time end -->
                        <FormField
                            v-model="report.end_date"
                            label="Datum einde van de actie"
                            name="EindDatum"
                            type="date"
                            rules="afterIncluding:@BeginDatum"
                            required
                        />
                        <FormField
                            v-model="report.end_time"
                            label="Tijdstip einde van de actie"
                            name="EindTijd"
                            type="time"
                            step="900"
                            rules=""
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
                    <div class="flex flex-col h-32 mt-5 space-y-3">
                        <!-- Image -->
                        <form-image
                            v-model="report.image"
                            :previous-image="report.image"
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

import { ValidationObserver, validate, ValidationProvider } from 'vee-validate';
import ValidatedFormField from '../formfields/ValidatedFormField';

import { caseHelper } from '../../mixins/caseHelper';
import { addHours } from 'date-fns';

export default {
    name: "Actie",
    components: {
        ValidationProvider,
        ValidationObserver,
        ValidatedFormField
    },
    mixins: [
        caseHelper,
    ],
    data: () => {
        return {
            actionUrls: []
        };
    },
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
        },
    },
    methods: {
        addActionUrl() {
            if (typeof this.actionUrls.find((o) => { return o.name == this.report.externe_link }) == 'undefined'
                && typeof this.report.externe_link !== 'undefined'
                && this.report.externe_link.length > 0) {

                validate(this.report.externe_link, 'url')
                    .then((result) => {
                        if (result.valid) {
                            if (/^https?:\/\//.test(this.report.externe_link) == false) {
                                this.report.externe_link = 'https://' + this.report.externe_link;
                            }
                            this.actionUrls.unshift(this.report.externe_link);
                            this.report.actionUrls = this.actionUrls.join(" \n");
                            this.report.externe_link = '';
                        }
                    })
            }
        },
        addHours(timeString, hoursToAdd) {
            // Split the time string into hours and minutes and create Date object
            let [hours, minutes] = timeString.split(':');
            let oldTime = new Date(0, 0, 0, hours, minutes);

            // Add an hour to the original time
            let newTime = addHours(oldTime, hoursToAdd);

            // Format the new time back to "HH:MM" format
            let formattedNewTime = newTime.getHours().toString().padStart(2, '0') + ':' + newTime.getMinutes().toString().padStart(2, '0');
            return formattedNewTime;
        },
        removeActionUrl(url) {
            let index = this.actionUrls.indexOf(url);
            if (index !== -1) {
            this.actionUrls.splice(index, 1);
            }
        },
    }
}
</script>

<style lang="scss" scoped>
    button.plus-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 5px;
        padding: 10px;
    }    
</style>