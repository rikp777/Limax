import Vue from "vue";
import Vuex from "vuex";

import auth from '../store/modules/auth.js'
import user from '../store/modules/user.js'
import palletLabel from '../store/modules/palletLabel.js'
import article from '../store/modules/article'
import cell from '../store/modules/cell'
import cultivationCycle from '../store/modules/cultivationCycle'
import palletType from '../store/modules/palletType'
import farmer from '../store/modules/farmer'

Vue.use(Vuex);

export default new Vuex.Store({
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
