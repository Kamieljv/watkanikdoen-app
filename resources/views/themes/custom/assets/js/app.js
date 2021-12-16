/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./wave');

window.Vue = require('vue').default;

// Load additional packages
import Vuetify, {
  VSkeletonLoader,
} from 'vuetify/lib'

Vue.use(Vuetify, {
  components: {
    VSkeletonLoader
  }
})
const vuetify = new Vuetify({})

import _ from 'lodash'
Vue.prototype.__ = str => _.get(window.i18n, str)

require('@fortawesome/fontawesome-free/js/all.min.js');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

new Vue({
  vuetify,
}).$mount('#app')