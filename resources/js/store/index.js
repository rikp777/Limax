import Vue from "vue";
import Vuex from "vuex";

import auth from '../store/modules/auth.js'
import user from '../store/modules/user.js'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        user,
    },
});