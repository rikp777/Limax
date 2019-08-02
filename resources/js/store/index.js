import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from 'vuex-persistedstate';

const vuexLocal = new VuexPersist({
    key: 'cache',
    storage: window.localStorage,
});

import auth from './modules/auth.module.js'
import user from '../store/modules/user.js'
import palletLabel from '../store/modules/palletLabel.js'
import article from './modules/article.module'
import cell from '../store/modules/cell'
import cultivationCycle from '../store/modules/cultivationCycle'
import palletType from '../store/modules/palletType'
import farmer from '../store/modules/farmer'

Vue.use(Vuex);

export default new Vuex.Store({
    plugins: [vuexLocal],
    modules: {
        auth,
        user,
        palletLabel,
        palletType,
        cultivationCycle,
        article,
        cell,
        farmer,
    },
});
