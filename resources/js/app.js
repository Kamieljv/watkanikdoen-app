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
import _ from "lodash"
app.provide("__", str => _.get(window.i18n, str))

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
import StatsDashboard from "./components/StatsDashboard.vue"
import AdminMenu from "./components/StatsDashboard.vue"
app.component("StatsDashboard", StatsDashboard)
app.component("AdminMenu", AdminMenu)
// Load Voyager assets
// import "../../public/vendor/tcg/voyager/assets/js/app"

app.mount("#app")
