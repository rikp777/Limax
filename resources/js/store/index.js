import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import SecureLS from "secure-ls";
var ls = new SecureLS({
    encodingType: 'rc4',
    isCompression: true,
    encryptionSecret: 'limax2@2@'
});

import auth from './modules/auth.module.js'
import user from '../store/modules/user.js'
import palletLabel from './modules/palletLabel.module.js'
import shippingLabel from './modules/shippingLabel.module'
import truck from './modules/truck.module'
import article from './modules/article.module'
import cell from './modules/cell.module'
import articlefarmer from './modules/articlefarmer.module'
import sortfarmer from './modules/sortfarmer.module'
import role from './modules/role.module'
import department from './modules/department.module'
import report from './modules/report.module'
import logistics from './modules/logistics.module'
import transport from './modules/transport.module'
import planning from './modules/planning.module'
import cultivationCycle from '../store/modules/cultivationCycle'
import palletType from './modules/palletType.module'
import cask from './modules/cask.module'
import inset from './modules/inset.module'
import articlegroup from './modules/articlegroup.module'
import sort from './modules/sort.module'
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
        createPersistedState({
            storage: {
                getItem: key => ls.get(key),
                setItem: (key, value) => ls.set(key, value),
                removeItem: key => ls.remove(key)
            }
        })
    ],
    modules: {
        menu,
        auth,
        user,
        palletLabel,
        shippingLabel,
        truck,
        palletType,
        cask,
        inset,
        articlegroup,
        sort,
        // cultivationCycle,
        article,
        cell,
        role,
        farmer,
        report,
        planning,
        department,
        articlefarmer,
        sortfarmer,
        logistics,
        transport
    },
});
