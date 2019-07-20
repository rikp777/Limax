import { getLocalUser } from "../../helpers/auth.js";

const user = getLocalUser();

// Initial State
const state = {
    authUser: user,
    isLoggedIn: !! user,
    loading: false,
    auth_error: null,
};

// Getters
const getters = {
    isLoading(state){
        return state.loading;
    },
    isLoggedIn(state){
        return state.isLoggedIn;
    },
    authUser(state){
        return state.authUser
    },
    authError(state){
        return state.auth_error;
    },
};

// Actions
const actions = {
    login(context){
        context.commit("login")
    },
    logout(context){
        if (context.getters.isLoggedIn) {
            console.log(context);
            return new Promise((resolve, reject) => {
                axios.post('/api/logout')
                    .then(response => {
                        localStorage.removeItem('user');
                        context.commit('logout');
                        resolve(response)
                    })
                    .catch(error => {
                        localStorage.removeItem('user');
                        context.commit('logout');
                        reject(error)
                    })
            })
        }
    }
};

// Mutations
const mutations = {
    login(state){
        state.loading = true;
        state.auth_error = null;
    },
    loginSuccess(state, payload){
        state.auth_error = null;
        state.isLoggedIn = true;
        state.loading = false;
        state.authUser = Object.assign({}, payload.user, {token: payload.access_token});

        localStorage.setItem("user", JSON.stringify(state.authUser));
    },
    loginFailed(state, payload){
        state.loading = false;
        state.auth_error = payload.error;
    },
    logout(state){
        localStorage.removeItem("user");
        state.isLoggedIn = false;
        state.authUser = null;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}