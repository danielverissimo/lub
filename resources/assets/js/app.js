
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./jquery.mask.min');
require('./underscore/underscore-min');
require('../centaurus/js/scripts');
require('../centaurus/js/jquery.nanoscroller.min');
require('../centaurus/js/pace.min');
require('./sweetalert.min');
require('./modernizr-custom');
require('./notificationFx');
require('./laravel-delete');
require('./bootstrap-datepicker.min');
require('./bootstrap-datepicker.pt-BR.min');
require('./scripts');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('grid', require('./components/Grid.vue'));
Vue.component('grid-modal', require('./components/GridModal.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));

const app = new Vue({
    el: '#app'
});