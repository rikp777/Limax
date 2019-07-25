require('./bootstrap');
import Vue from 'vue';
import router  from './router/index.js'
import store from './store/index.js';
import MainApp from './components/MainApp.vue'
import {initialize} from "./helpers/general";
import Swal from 'sweetalert2'
import VeeValidate from 'vee-validate';
import bootstrapSelect from 'bootstrap-select';

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



initialize(store, router);
//throw router;
//throw store;

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});