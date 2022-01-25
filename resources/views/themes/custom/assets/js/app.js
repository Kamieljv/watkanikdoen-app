/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap")
require("./wave")

window.Vue = require("vue").default

/** 
 * Load additional packages
 */
// Lodash for language
import _ from "lodash"
Vue.prototype.__ = str => _.get(window.i18n, str)

// VueTailwind for components
import VueTailwind from "vue-tailwind"
import VueTailwindSettings from "../../VueTailwindSettings.js"
Vue.use(VueTailwind, VueTailwindSettings)

// SVG Vue
import SvgVue from "svg-vue"
Vue.use(SvgVue)

// Image upload/edit
import 'exif-js'
import VueCroppie from 'vue-croppie';
import 'croppie/croppie.css' // import the croppie css manually
Vue.use(VueCroppie);

import { LMap, LTileLayer, LMarker, LTooltip } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
Vue.component('LMap', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component("l-tooltip", LTooltip)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context("./", true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split("/").pop().split(".")[0], files(key).default))

// Also load CoordinatesFormField from Voyager section
import CoordinatesFormField from '../../../../../js/components/CoordinatesFormField'
Vue.component('CoordinatesFormField', CoordinatesFormField)