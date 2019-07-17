import { getLocalUser } from "../../helpers/auth.js";

const user = getLocalUser();

// Initial State
const state = {
    users: []
};

// Getters
const getters = {
    all(state){
        return state.users;
    },
};

// Actions
const actions = {
    getUsers(context){
        axios.get('/api/user')
            .then((response) => {
                context.commit('userUpdate', response.data);
            })
    }
};

// Mutations
const mutations = {
    userUpdate(state, payload){
        state.users = payload
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}