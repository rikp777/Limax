import ApiService from "./common/api.service";

require('./bootstrap');
import Vue from 'vue';
import router  from './router/index.js'
import store from './store/index.js';
import MainApp from './components/mainapp.vue'
import AccessControl from "./helpers/accesscontrol";
import Swal from 'sweetalert2'
import VeeValidate from 'vee-validate';
import bootstrapSelect from 'bootstrap-select';
import moment from 'moment';
import VueHtmlToPaper from 'vue-html-to-paper';


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

window.moment = moment;
Vue.prototype.moment = moment

window.bootstrapSelect = bootstrapSelect;
// import BootstrapVue from 'bootstrap-vue'
// import VueRouter from 'vue-router';
// import {routes} from './routes';
//Vue.use(BootstrapVue);
// import Vuetify from 'vuetify'
// Vue.use(Vuetify);
// Vue.use(VueRouter);
Vue.use(VeeValidate);
window.Swal = Swal;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
});
window.Toast = toast;

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
