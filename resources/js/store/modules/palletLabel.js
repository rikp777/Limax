
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
};

// Actions
const actions = {
    getAll(context){
        axios.get('/api/palletlabel')
            .then((response) => {
                context.commit('palletLabelsUpdate', response.data);
            })
    },
    getById(context, id){
        axios.get('/api/palletlabel/' + id)
            .then((response) => {
                context.commit('palletLabelUpdate', response.data);
            })
    },
};

// Mutations
const mutations = {
    palletLabelsUpdate(state, payload){
        state.all = payload
    },
    palletLabelUpdate(state, payload){
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