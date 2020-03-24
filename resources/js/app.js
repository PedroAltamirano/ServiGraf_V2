require('./bootstrap');
window.Vue = require('vue');

Vue.component('carousel', require('vue-owl-carousel'));
Vue.component('fab-comp', require('./components/fab.vue').default);
Vue.component('datatable', require('./components/tables.vue'));
Vue.component('board', require('./components/blueBoard.vue'));

const app = new Vue({
    el: '#app'
});