/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./custom";
import { createApp, defineAsyncComponent } from "vue";
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
        50: "{blue.50}",
        100: "{blue.100}",
        200: "{blue.200}",
        300: "{blue.300}",
        400: "{blue.400}",
        500: "{blue.500}",
        600: "{blue.600}",
        700: "{blue.700}",
        800: "{blue.800}",
        900: "{blue.900}",
        950: "{blue.950}",
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
app.provide("translate", (str, params = {}) => {
  let translation = get(window.i18n, str, str);

  // Replace :param placeholders with actual values
  if (params && typeof params === "object") {
    Object.keys(params).forEach((key) => {
      translation = translation.replace(
        new RegExp(`:${key}`, "g"),
        params[key],
      );
    });
  }

  return translation;
});

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

// Register Vue components used in blade files as async components so each
// page only downloads the JS (and heavy deps like Leaflet/Tiptap/cropper)
// for the components it actually renders, instead of shipping all of them
// in the single app.js entry loaded on every page.
const asyncComponent = (loader) => defineAsyncComponent(loader);

app.component(
  "ActieAgenda",
  asyncComponent(() => import("./components/apps/ActieAgenda.vue")),
);
app.component(
  "ActieWijzer",
  asyncComponent(() => import("./components/apps/ActieWijzer.vue")),
);
app.component(
  "AddActie",
  asyncComponent(() => import("./components/apps/AddActie.vue")),
);
app.component(
  "Books",
  asyncComponent(() => import("./components/apps/Books.vue")),
);
app.component(
  "BookShelf",
  asyncComponent(() => import("./components/partials/BookShelf.vue")),
);
app.component(
  "BookShelves",
  asyncComponent(() => import("./components/partials/BookShelves.vue")),
);
app.component(
  "Collapsible",
  asyncComponent(() => import("./components/partials/Collapsible.vue")),
);
app.component(
  "CopyTextField",
  asyncComponent(() => import("./components/partials/CopyTextField.vue")),
);
app.component(
  "ForgotPassword",
  asyncComponent(() => import("./components/forms/ForgotPassword.vue")),
);
app.component(
  "HomeAgenda",
  asyncComponent(() => import("./components/apps/HomeAgenda.vue")),
);
app.component(
  "LoginRegister",
  asyncComponent(() => import("./components/apps/LoginOrRegister.vue")),
);
app.component(
  "Newsletter",
  asyncComponent(() => import("./components/forms/Newsletter.vue")),
);
app.component(
  "Notifications",
  asyncComponent(() => import("./components/apps/Notifications.vue")),
);
app.component(
  "Organizers",
  asyncComponent(() => import("./components/apps/Organizers.vue")),
);
app.component(
  "OrganizersFeatured",
  asyncComponent(() => import("./components/apps/OrganizersFeatured.vue")),
);
app.component(
  "Profile",
  asyncComponent(() => import("./components/forms/Profile.vue")),
);
app.component(
  "ProgressBar",
  asyncComponent(() => import("./components/partials/ProgressBar.vue")),
);
app.component(
  "Referentie",
  asyncComponent(() => import("./components/partials/Referentie.vue")),
);
app.component(
  "Referenties",
  asyncComponent(() => import("./components/apps/Referenties.vue")),
);
app.component(
  "ResetPassword",
  asyncComponent(() => import("./components/forms/ResetPassword.vue")),
);
app.component(
  "Security",
  asyncComponent(() => import("./components/forms/Security.vue")),
);
app.component(
  "SimpleMap",
  asyncComponent(() => import("./components/partials/SimpleMap.vue")),
);
app.component(
  "WidgetAgenda",
  asyncComponent(() => import("./components/apps/WidgetAgenda.vue")),
);

app.mount("#app");
