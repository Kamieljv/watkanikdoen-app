/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./custom";
import { createApp } from "vue";
import PrimeVue from "primevue/config";
import { definePreset } from "@primeuix/themes";
import Aura from "@primeuix/themes/aura";

const CustomPreset = definePreset(Aura, {
  options: {
    prefix: "color",
  },
  semantic: {
    primary: {
      root: {
        50: '{blue.50}',
        100: '{blue.100}',
        200: '{blue.200}',
        300: '{blue.300}',
        400: '{blue.400}',
        500: '{blue.500}',
        600: '{blue.600}',
        700: '{blue.700}',
        800: '{blue.800}',
        900: '{blue.900}',
        950: '{blue.950}'
      },
    },
  },
  components: {
    dialog: {
      colorScheme: {
        light: {
          root: {
            borderColor: "none",
          },
          content: {
            padding: "1rem",
          },
        },
      },
    },
    radiobutton: {
      colorScheme: {
        light: {
          icon: {
            checkedColor: "rgba(255, 255, 255, 0.5)",
            checkedHoverColor: "rgba(255, 255, 255, 0.5)",
          },
        },
      },
    },
  },
});

const app = createApp();
app.use(PrimeVue, {
  theme: {
    preset: CustomPreset,
    options: {
      darkModeSelector: false || "none",
    },
  },
});

// Lodash for language
import get from "lodash/get";
app.provide("translate", (str) => get(window.i18n, str));

// AlpineJS
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

// Vee-validate
import { setLocale } from "@vee-validate/i18n";
setLocale("nl");
import "./validations";

// Vue Sanitize for HTML sanitization
import VueSanitize from "vue-sanitize-directive";
app.use(VueSanitize);

// Image upload/edit
import "exif-js";

import { LMap, LTileLayer, LMarker, LTooltip } from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";
app
  .component("LMap", LMap)
  .component("l-tile-layer", LTileLayer)
  .component("l-marker", LMarker)
  .component("l-tooltip", LTooltip);

// Import and register Vue components that are used in blade files
import ActieAgenda from "./components/apps/ActieAgenda.vue";
import ActieWijzer from "./components/apps/ActieWijzer.vue";
import AddActie from "./components/apps/AddActie.vue";
import BookItemList from "./components/partials/BookItemList.vue";
import Books from "./components/apps/Books.vue";
import Collapsible from "./components/partials/Collapsible.vue";
import CopyTextField from "./components/partials/CopyTextField.vue";
import ForgotPassword from "./components/forms/ForgotPassword.vue";
import HomeAgenda from "./components/apps/HomeAgenda.vue";
import LoginOrRegister from "./components/apps/LoginOrRegister.vue";
import Newsletter from "./components/forms/Newsletter.vue";
import Notifications from "./components/apps/Notifications.vue";
import Organizers from "./components/apps/Organizers.vue";
import OrganizersFeatured from "./components/apps/OrganizersFeatured.vue";
import Profile from "./components/forms/Profile.vue";
import ProgressBar from "./components/partials/ProgressBar.vue";
import Referentie from "./components/partials/Referentie.vue";
import Referenties from "./components/apps/Referenties.vue";
import ResetPassword from "./components/forms/ResetPassword.vue";
import Security from "./components/forms/Security.vue";
import SimpleMap from "./components/partials/SimpleMap.vue";
import WidgetAgenda from "./components/apps/WidgetAgenda.vue";
app.component("ActieAgenda", ActieAgenda);
app.component("ActieWijzer", ActieWijzer);
app.component("AddActie", AddActie);
app.component("Books", Books);
app.component("BookItemList", BookItemList);
app.component("Collapsible", Collapsible);
app.component("CopyTextField", CopyTextField);
app.component("ForgotPassword", ForgotPassword);
app.component("HomeAgenda", HomeAgenda);
app.component("LoginRegister", LoginOrRegister);
app.component("Newsletter", Newsletter);
app.component("Notifications", Notifications);
app.component("Organizers", Organizers);
app.component("OrganizersFeatured", OrganizersFeatured);
app.component("Profile", Profile);
app.component("ProgressBar", ProgressBar);
app.component("Referentie", Referentie);
app.component("Referenties", Referenties);
app.component("ResetPassword", ResetPassword);
app.component("Security", Security);
app.component("SimpleMap", SimpleMap);
app.component("WidgetAgenda", WidgetAgenda);

app.mount("#app");
