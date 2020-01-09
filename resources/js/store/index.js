import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from 'vuex-persistedstate';
import Cookies from 'js-cookie'


import auth from './modules/auth.module.js'
import user from '../store/modules/user.js'
import palletLabel from './modules/palletLabel.module.js'
import shippingLabel from './modules/shippingLabel.module'
import truck from './modules/truck.module'
import article from './modules/article.module'
import cell from './modules/cell.module'
import role from './modules/role.module'
import articlefarmer from './modules/articlefarmer.module'
import department from './modules/department.module'
import report from './modules/report.module'
import cultivationCycle from '../store/modules/cultivationCycle'
import palletType from './modules/palletType.module'
import farmer from './modules/farmer.module'
import moment from "moment";

Vue.use(Vuex);
const production = false;
export default new Vuex.Store({
    plugins: [
        VuexPersist({
            storage: {
                getItem: key => Cookies.get(key),
                setItem: (key, value) => Cookies.set(key, value, {secure: production }),
                removeItem: key => Cookies.remove(key)
            }
        })
    ],
    modules: {
        auth,
        user,
        palletLabel,
        shippingLabel,
        truck,
        palletType,
        cultivationCycle,
        article,
        cell,
        role,
        farmer,
        report,
        department,
        articlefarmer,
    },
});
