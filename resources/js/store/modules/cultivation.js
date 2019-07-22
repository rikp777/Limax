
//api url
const apiUrl = '/api/cultivation';

// Initial State
const state = {
    all: [],
    calculation: [],
};

// Getters
const getters = {
    all(state){
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
    getCalculationCell(context, id){
        if(id){
            axios.get(apiUrl + '/calculate/' + id)
                .then((response) => {
                    context.commit('UpdateCalculation', response.data);
                })
        }
    }
};

// Mutations
const mutations = {
    UpdateAll(state, payload){
        state.all = payload
    },
    UpdateCalculation(state, payload){
        state.calculation = payload
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}