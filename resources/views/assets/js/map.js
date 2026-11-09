import { createApp } from "vue";
import get from "lodash/get";
import ActieMap from "./components/apps/ActieMap.vue";

const app = createApp({});

app.provide("translate", (str, params = {}) => {
  let translation = get(window.i18n, str, str);
  Object.keys(params || {}).forEach((key) => {
    translation = translation.replace(new RegExp(`:${key}`, "g"), params[key]);
  });
  return translation;
});

app.component("ActieMap", ActieMap);
app.mount("#app");
