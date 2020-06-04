require('./bootstrap');
require('jquery');

window.Vue = require('vue');

//librerias
import 'popper.js';
import 'animate.css';

import 'jszip';
import 'pdfmake';
import 'datatables.net-bs4';
import 'datatables.net-buttons-bs4';
import 'datatables.net-buttons/js/buttons.html5.js';
import 'datatables.net-buttons/js/buttons.print.js';
import 'datatables.net-fixedheader-bs4';
import 'datatables.net-keytable-bs4';
import 'datatables.net-responsive-bs4';
import 'datatables.net-rowgroup-bs4';


//components
import blueBoard from './components/blueBoard.vue';
import pathRoute from './components/pathRoute.vue';

Vue.component('carousel', require('vue-owl-carousel'));
Vue.component('fab-comp', require('./components/fab.vue').default);
// Vue.component('test-comp', require('./components/test.vue'));
Vue.component('path-route', pathRoute);
Vue.component('blue-board', blueBoard);

const app = new Vue({
	el: '#app',
});

const fab = new Vue({
	el: '#fab',
});