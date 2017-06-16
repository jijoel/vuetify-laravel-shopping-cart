
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
Vue.component('SProductCard', require('./components/ProductCard.vue'));
Vue.component('SShoppingCart', require('./components/ShoppingCart.vue'));

Vue.filter('money', (value) => {
    // We get cents, and return a formatted dollar amount.
    //
    // neither Intl.NumberFormat nor toLocaleString
    // seems to be working, so doing a nasty hacky thing
    // return '$' + (value / 100).toLocaleString({
    //     style: 'currency',
    //     currency: 'USD',
    //     minimumFractionDigits: 2,
    //     maximumFractionDigits: 2,
    // });

    function reverse(str) {
        return str.split('').reverse().join('');
    }

    function num2str(num) {
        var str = num+"";
        return reverse(reverse(str).replace(/\d{3}/g,'$&,').replace(/\,$/,''));
    }

    const ds = (num2str(value / 100)+'.00').split('.');

    return '$' + ds[0] + '.' + (ds[1]+'00').substring(0,2);
})



import store from './store';

const app = new Vue({
    el: '#app',
    store,
});
