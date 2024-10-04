/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap"
import "./custom"
import { createApp } from "vue"
import PrimeVue from "primevue/config"
import Aura from '../presets/aura'

const app = createApp()
app.use(PrimeVue, {
    unstyled: true,
    pt: Aura
})

// Lodash for language
import _ from "lodash"
app.provide('__', str => _.get(window.i18n, str)); 

// Vee-validate
import { setLocale } from "@vee-validate/i18n"
setLocale('nl')
import './validations'

// Image upload/edit
import "exif-js"
import VueCroppie from "vue-croppie"
import "croppie/croppie.css" // import the croppie css manually
app.use(VueCroppie)

import { LMap, LTileLayer, LMarker, LTooltip } from "@vue-leaflet/vue-leaflet"
import "leaflet/dist/leaflet.css"
app.component("LMap", LMap)
    .component("l-tile-layer", LTileLayer)
    .component("l-tile-layer", LTileLayer)
    .component("l-marker", LMarker)
    .component("l-tooltip", LTooltip)

// Import and register Vue components that are used in blade files
import ActieAgenda from "./components/apps/ActieAgenda.vue"
import ActieWijzer from "./components/apps/ActieWijzer.vue"
import AddActie from "./components/apps/AddActie.vue"
import HomeAgenda from "./components/apps/HomeAgenda.vue"
import Organizers from "./components/apps/Organizers.vue"
import OrganizersFeatured from "./components/apps/OrganizersFeatured.vue"
app.component("ActieAgenda", ActieAgenda)
app.component("ActieWijzer", ActieWijzer)
app.component("AddActie", AddActie)
app.component("HomeAgenda", HomeAgenda)
app.component("Organizers", Organizers)
app.component("OrganizersFeatured", OrganizersFeatured)

  
// Admin portal components
import CoordinatesFormField from "../../../js/components/CoordinatesFormField.vue"
app.component("CoordinatesFormField", CoordinatesFormField)

app.mount("#app")