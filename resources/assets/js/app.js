
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex'
Vue.use(Vuex);

require('vuetify');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('shop', require('./components/StoreFront.vue'));
Vue.component('SToolbar', require('./components/Toolbar.vue'));
Vue.component('SCoupons', require('./components/Coupons.vue'));
Vue.component('SProductList', require('./components/ProductList.vue'));
Vue.component('SShoppingCart', require('./components/ShoppingCart.vue'));

const app = new Vue({
    el: '#app'
});
