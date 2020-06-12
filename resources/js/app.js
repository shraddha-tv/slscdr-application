/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Vuex from 'vuex';
// import { ValidationProvider } from 'vee-validate';

Vue.use(Vuetify)
Vue.use(Vuex)
// Vue.use(ValidationProvider)

import store from './store/index';
import router from './router'

const opts = {}
const vuetify = new Vuetify(opts);

require('./bootstrap');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('main-component', require('./components/index.vue').default);
Vue.component('table-toolbar', require('./components/Common/TableToolbar.vue').default);
Vue.component('tableheader-selector', require('./components/Common/TableHeaderSelector.vue').default);
Vue.component('table-pagination', require('./components/Common/Pagination.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify,
    store,
    router
});
