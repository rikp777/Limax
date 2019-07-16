import Axios from "axios";

require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'Vuex';
import {routes} from './routes';
import StoreData from './store';
import MainApp from './components/MainApp.vue'
import {initialize} from "./helpers/general";
import SweetAlert2  from 'sweetalert2'

Vue.use(VueRouter);
Vue.use(Vuex);
window.swal = SweetAlert2;

const store = new Vuex.Store(StoreData);
const router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(store, router);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});






// window.Vue = require('vue');
// window.Vuetify = require('vuetify');
// Vue.component('app', require('./MainApp.vue').default);
//
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));