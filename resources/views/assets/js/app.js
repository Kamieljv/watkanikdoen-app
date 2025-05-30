/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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
import get from "lodash/get"
app.provide("translate", str => get(window.i18n, str)); 

// AlpineJS
import Alpine from "alpinejs"
window.Alpine = Alpine;
Alpine.start();

// Vee-validate
import { setLocale } from "@vee-validate/i18n"
setLocale('nl')
import './validations'

// Image upload/edit
import "exif-js"

import { LMap, LTileLayer, LMarker, LTooltip } from "@vue-leaflet/vue-leaflet"
import "leaflet/dist/leaflet.css"
app.component("LMap", LMap)
    .component("l-tile-layer", LTileLayer)
    .component("l-marker", LMarker)
    .component("l-tooltip", LTooltip)

// Import and register Vue components that are used in blade files
import ActieAgenda from "./components/apps/ActieAgenda.vue"
import ActieWijzer from "./components/apps/ActieWijzer.vue"
import AddActie from "./components/apps/AddActie.vue"
import Collapsible from "./components/partials/Collapsible.vue"
import CopyTextField from "./components/partials/CopyTextField.vue"
import ForgotPassword from "./components/forms/ForgotPassword.vue"
import HomeAgenda from "./components/apps/HomeAgenda.vue"
import LoginOrRegister from "./components/apps/LoginOrRegister.vue"
import Newsletter from "./components/forms/Newsletter.vue"
import Notifications from "./components/apps/Notifications.vue"
import Organizers from "./components/apps/Organizers.vue"
import OrganizersFeatured from "./components/apps/OrganizersFeatured.vue"
import Profile from "./components/forms/Profile.vue"
import ProgressBar from "./components/partials/ProgressBar.vue"
import Referentie from "./components/partials/Referentie.vue"
import Referenties from "./components/apps/Referenties.vue"
import ResetPassword from "./components/forms/ResetPassword.vue"
import Security from "./components/forms/Security.vue"
import SimpleMap from "./components/partials/SimpleMap.vue"
import WidgetAgenda from "./components/apps/WidgetAgenda.vue"
app.component("ActieAgenda", ActieAgenda)
app.component("ActieWijzer", ActieWijzer)
app.component("AddActie", AddActie)
app.component("Collapsible", Collapsible)
app.component("CopyTextField", CopyTextField)
app.component("ForgotPassword", ForgotPassword)
app.component("HomeAgenda", HomeAgenda)
app.component("LoginRegister", LoginOrRegister)
app.component("Newsletter", Newsletter)
app.component("Notifications", Notifications)
app.component("Organizers", Organizers)
app.component("OrganizersFeatured", OrganizersFeatured)
app.component("Profile", Profile)
app.component("ProgressBar", ProgressBar)
app.component("Referentie", Referentie)
app.component("Referenties", Referenties)
app.component("ResetPassword", ResetPassword)
app.component("Security", Security)
app.component("SimpleMap", SimpleMap)
app.component("WidgetAgenda", WidgetAgenda)
  
// Admin portal components
import CoordinatesFormField from "../../../js/components/CoordinatesFormField.vue"
app.component("CoordinatesFormField", CoordinatesFormField)

app.mount("#app")