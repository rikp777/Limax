import ApiService from "./common/api.service";

require('./bootstrap');
import Vue from 'vue';
import router  from './router/index.js'
import store from './store/index.js';
import MainApp from './components/MainApp.vue'
import AccessControl from "./helpers/accessControl";
// import Swal from 'sweetalert2'
import VeeValidate from 'vee-validate';
import bootstrapSelect from 'bootstrap-select';
import moment from 'moment';
import VueHtmlToPaper from 'vue-html-to-paper'
import Multiselect from 'vue-multiselect'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const swalStylingoptions = {
    confirmButtonColor: '#F2AB58',
    cancelButtonColor: '#eb5b65',
};

Vue.use(VueSweetalert2, swalStylingoptions);

import "chart.js";
import "hchs-vue-charts";
Vue.use(window.VueCharts);

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);


import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(fas);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('multiselect', Multiselect);
//
// Vue.config.productionTip = false;
//
//
const options = {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    styles: [
        'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
        'https://unpkg.com/kidlat-css/css/kidlat.css'
    ]
};
Vue.use(VueHtmlToPaper, options);
// //
window.moment = moment;
Vue.prototype.moment = moment;
//
window.bootstrapSelect = bootstrapSelect;
import VueRouter from 'vue-router';

Vue.use(VueRouter);
Vue.use(VeeValidate);
// window.Swal = Swal;
//
// const toast = Swal.mixin({
//     toast: true,
//     position: 'top-end',
//     showConfirmButton: false,
//     timer: 3000,
// });
// window.Toast = toast;
//
ApiService.initialize();
AccessControl.router(store, router);




const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
