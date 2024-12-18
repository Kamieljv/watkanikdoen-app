/**
 * This JS adds to the voyager base JS asset.
 * Vue, jQuery and BootstrapJS (among others) are loaded there.
 */

import { createApp } from "vue"
import PrimeVue from "primevue/config"
import Aura from '../views/assets/presets/aura'

const app = createApp()
app.use(PrimeVue, {
    unstyled: true,
    pt: Aura
})

// Lodash for language
import get from "lodash/get"
app.provide("translate", str => get(window.i18n, str)); 

// Vee-validate
import { setLocale } from "@vee-validate/i18n"
setLocale("nl")
import "../views/assets/js/validations"


import { LMap, LTileLayer, LMarker, LTooltip } from "@vue-leaflet/vue-leaflet"
import "leaflet/dist/leaflet.css"
app.component("LMap", LMap)
    .component("l-tile-layer", LTileLayer)
    .component("l-tile-layer", LTileLayer)
    .component("l-marker", LMarker)
    .component("l-tooltip", LTooltip)

// Import and register Vue components that are used in blade files
import CoordinatesFormField from "./components/CoordinatesFormField.vue"
import EditAnswersFormField from "./components/EditAnswersFormField.vue"
import ScoreRelationFormField from "./components/ScoreRelationFormField.vue"
import StatsDashboard from "./components/StatsDashboard.vue"
app.component("CoordinatesFormField", CoordinatesFormField)
app.component("EditAnswersFormField", EditAnswersFormField)
app.component("ScoreRelationFormField", ScoreRelationFormField)
app.component("StatsDashboard", StatsDashboard)

app.mount("#app")
