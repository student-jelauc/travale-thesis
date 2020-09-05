/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.queryString = require('query-string');
window.Vue = require('vue');
window.moment = require('moment');
window.VueEvent = new Vue();
window.Swal = require('sweetalert2');
window.Swal = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false,
});

require('bootstrap-datepicker');
require('bootstrap-select');
require('bootstrap-tagsinput');
require('datatables.net-bs4');
require('moment');
require('select2');


$.fn.select2.defaults.set("theme", "bootstrap");

Vue.mixin({
    methods: {
        route: route,
        moment: moment,
    }
});

Vue.component('dropzone', require('./components/Dropzone').default);
Vue.component('gallery', require('./components/Gallery').default);
