
//api url
const apiUrl = '/api/cultivationcycle';

// Initial State
const state = {
    all: [],
    calculation: [],
};

// Getters
const getters = {
    getAll(state){
        return state.all;
    },
    getById: (state) => (id) => {
        return state.all.find(article => article.id === id);
    },
    getCalculation(state){
        return state.calculation;
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
    getCalculationCell(context, id){
        return new Promise((resolve, reject) => {
            axios.get(apiUrl + '/calculate/' + id)
                .then((response) => {
                    resolve(response);
                    context.commit('UpdateCalculation', response.data);
                });
        })
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