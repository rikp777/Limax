//api url
const apiUrl = '/api/farmer';

// Initial State
const state = {
    farmers: [],
};

// Getters
const getters = {
    getAll(state) {
        return state.farmers;
    },
    getById: (state) => (id) => {
        return state.farmers.find(farmer => farmer.id === id);
    },
    getByName: (state) => (name) => {
        return state.farmers.match(name);
    }
};

// Actions
const actions = {
    getAll(context) {
        return new Promise((resolve, reject) => {
            axios
                .get(apiUrl)
                .then((response) => {
                    context.commit('setAll', response.data);
                    resolve(response)
                })
                .catch((error) => {
                    reject(error)
                })
        })
    }
};

// Mutations
const mutations = {
    setAll(state, payload) {
        state.famers = payload
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
