/**
 * This JS adds to the voyager base JS asset.
 * Vue, jQuery and BootstrapJS (among others) are loaded there.
 */

// Load Leaflet
import { LMap, LTileLayer, LMarker, LTooltip } from "vue2-leaflet"
import "leaflet/dist/leaflet.css"
Vue.component("l-map", LMap)
Vue.component("l-tile-layer", LTileLayer)
Vue.component("l-marker", LMarker)
Vue.component("l-tooltip", LTooltip)

// Define translation directive ('__()')
import _ from "lodash"
Vue.prototype.__ = str => _.get(window.i18n, str)

// Add TinyMCE (rich text editor) paste plugin
// (https://www.tiny.cloud/docs-3x/reference/TinyMCE3x@Plugins/Plugin3x@paste/)
import "../../public/vendor/tcg/voyager/assets/js/plugins/paste/plugin.min.js"

// Load additional components
const files = require.context("./", true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split("/").pop().split(".")[0], files(key).default))

// Mount Vue instances
var coordinatesField = new Vue(
	{
		el: "#coordinates-formfield",
	}
)
