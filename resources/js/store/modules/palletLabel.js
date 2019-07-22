const apiUrl = '/api/palletlabel';
// Initial State
const state = {
    all: [],
    single: '',
};

// Getters
const getters = {
    all(state){
        return state.all;
    },
    single(state){
        return state.single
    }
};

// Actions
const actions = {
    getAll(context){
        axios.get(apiUrl)
            .then((response) => {
                context.commit('UpdateAll', response.data);
            })
    },
    getById(context, id){
        axios.get(apiUrl + '/' + id)
            .then((response) => {
                context.commit('UpdateSingle', response.data);
            })
    },
};

// Mutations
const mutations = {
    UpdateAll(state, payload){
        state.all = payload
    },
    UpdateSingle(state, payload){
        state.single = payload;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}