
//api url
const apiUrl = '/api/palletType';

// Initial State
const state = {
    all: [],
};

// Getters
const getters = {
    getAll(state){
        return state.all;
    },
    getById: (state) => (id) => {
        return state.all.find(article => article.id === id);
    },
};

// Actions
const actions = {
    getAll(context){
        axios.get(apiUrl)
            .then((response) => {
                context.commit('UpdateAll', response.data);
            })
    },
};

// Mutations
const mutations = {
    UpdateAll(state, payload){
        state.all = payload
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}