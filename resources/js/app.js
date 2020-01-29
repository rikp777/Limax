// import ApiService from "./common/api.service";
//
// require('./bootstrap');
// import Vue from 'vue';
// import router  from './router/index.js'
// import store from './store/index.js';
// import MainApp from './components/MainApp.vue'
// import AccessControl from "./helpers/accessControl";
// // import Swal from 'sweetalert2'
// import VeeValidate from 'vee-validate';
// import bootstrapSelect from 'bootstrap-select';
// import moment from 'moment';
// import VueHtmlToPaper from 'vue-html-to-paper'
// import Multiselect from 'vue-multiselect'
//
// import VueSweetalert2 from 'vue-sweetalert2';
// import 'sweetalert2/dist/sweetalert2.min.css';
//
// const swalStylingoptions = {
//     confirmButtonColor: '#F2AB58',
//     cancelButtonColor: '#eb5b65',
// };
//
// Vue.use(VueSweetalert2, swalStylingoptions);
//
// import "chart.js";
// import "hchs-vue-charts";
// Vue.use(window.VueCharts);
//
// import BootstrapVue from 'bootstrap-vue'
// Vue.use(BootstrapVue);
//
//
// import { library } from '@fortawesome/fontawesome-svg-core'
// import { fas } from '@fortawesome/free-solid-svg-icons'
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
//
// library.add(fas);
//
// Vue.component('font-awesome-icon', FontAwesomeIcon);
// Vue.component('multiselect', Multiselect);
// //
// // Vue.config.productionTip = false;
// //
// //
// const options = {
//     name: '_blank',
//     specs: [
//         'fullscreen=yes',
//         'titlebar=yes',
//         'scrollbars=yes'
//     ],
//     styles: [
//         'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
//         'https://unpkg.com/kidlat-css/css/kidlat.css'
//     ]
// };
// Vue.use(VueHtmlToPaper, options);
// // //
// window.moment = moment;
// Vue.prototype.moment = moment;
// //
// window.bootstrapSelect = bootstrapSelect;
// import VueRouter from 'vue-router';
//
// Vue.use(VueRouter);
// Vue.use(VeeValidate);
// // window.Swal = Swal;
// //
// // const toast = Swal.mixin({
// //     toast: true,
// //     position: 'top-end',
// //     showConfirmButton: false,
// //     timer: 3000,
// // });
// // window.Toast = toast;
// //
// ApiService.initialize();
// AccessControl.router(store, router);
// const app = new Vue({
//     el: '#app',
//     // router,
//     // store,
//     components: {
//         MainApp
//     }
// });
require('./bootstrap'); // moet weg
import '../js'

import Vue from 'vue'
import MainApp from './MainApp'

// BootstrapVue add
import BootstrapVue from 'bootstrap-vue';

// Router & Store add
import router  from './router/index.js'
import store from './store/index.js';
import AccessControl from "./utils/accessControl"; // moet weg
import ApiService from "./common/api.service"; // moet weg

import en from './locales/en';
import nl from './locales/nl';
import pl from './locales/pl';
import VueI18n from 'vue-i18n'
import { defaultLocale, localeOptions } from './constants/config'

// Notification Component Add
import Notification from './components/Common/Notification'

// Breadcrumb Component Add
import Breadcrumb from './components/Common/Breadcrumb'

// RefreshButton Component Add
import RefreshButton from './components/Common/RefreshButton'

// Colxx Component Add
import Colxx from './components/Common/Colxx'

// Perfect Scrollbar Add
import vuePerfectScrollbar from 'vue-perfect-scrollbar'
import contentMenu from 'v-contextmenu'
import VueLineClamp from 'vue-line-clamp'
import VCalendar from 'v-calendar'
import 'v-calendar/lib/v-calendar.min.css'
import VueScrollTo from 'vue-scrollto'
import Vuelidate from "vuelidate";

//Vue Uses
Vue.use(BootstrapVue);
Vue.use(VueI18n);
Vue.use(Notification);
Vue.use(require('vue-shortkey'));
Vue.use(contentMenu);
Vue.use(VueLineClamp, {
    importCss: true
});
Vue.use(VCalendar, {
    firstDayOfWeek: 2, // ...other defaults,
    formats: {
        title: 'MMM YY',
        weekdays: 'WW',
        navMonths: 'MMMM',
        input: ['L', 'YYYY-MM-DD', 'YYYY/MM/DD'],
        dayPopover: 'L'
    },
    datePickerShowDayPopover: false,
    popoverExpanded: true,
    popoverDirection: 'bottom'
});
Vue.use(VueScrollTo);
Vue.use(Vuelidate);

//Vue Components
Vue.component('piaf-breadcrumb', Breadcrumb);
Vue.component('b-refresh-button', RefreshButton);
Vue.component('b-colxx', Colxx);
Vue.component('vue-perfect-scrollbar', vuePerfectScrollbar);

const messages = { en: en, nl: nl, pl: pl };
const locale = (localStorage.getItem('currentLanguage')
    && localeOptions.filter(x => x.id === localStorage.getItem('currentLanguage')).length >0)
    ? localStorage.getItem('currentLanguage') : defaultLocale;
const i18n = new VueI18n({
    locale: locale,
    fallbackLocale: 'en',
    messages
});

ApiService.initialize();
AccessControl.router(store, router);

Vue.config.productionTip = false;
export default new Vue({
    i18n,
    router,
    store,
    render: h => h(MainApp)
}).$mount('#app')
