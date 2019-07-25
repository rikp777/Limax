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
            return new Promise((resolve, reject) => {
                axios.get(apiUrl)
                    .then((response) => {
                        resolve(response);
                        context.commit('UpdateAll', response.data);
                    })
                    .catch((error) => {
                        reject(error)
                    })
            })
        },
    getById(context, id){
        return new Promise((resolve, reject) => {
            axios.get(apiUrl + '/' + id)
                .then((response) => {
                    resolve(response);
                    context.commit('UpdateSingle', response.data.data);
                })
                .catch((error) => {
                    reject(error);
                })
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


