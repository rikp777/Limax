import Vue from "vue";
import Vuex from "vuex";

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
import planning from './modules/planning.module'
import cultivationCycle from '../store/modules/cultivationCycle'
import palletType from './modules/palletType.module'
import farmer from './modules/farmer.module'
import menu from './modules/menu.module'
import app from '../app'

Vue.use(Vuex);
export default new Vuex.Store({
    state: {

    },
    mutations: {
        changeLang(state, payload){
            app.$i18n.locale = payload;
            localStorage.setItem('currentLanguage', payload)
        }
    },
    actions: {
        setLang({ commit }, payload){
            commit('changeLang', payload)
        }
    },
    plugins: [
    ],
    modules: {
        menu,
        auth,
        user,
        palletLabel,
        // shippingLabel,
        // truck,
        // palletType,
        // cultivationCycle,
        // article,
        // cell,
        // role,
        farmer,
        // report,
        // planning,
        // department,
        // articlefarmer,
    },
});
