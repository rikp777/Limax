const apiUrl = '/api/palletlabel';
// Initial State
const state = {
    palletLabels: [],
};

// Getters
const getters = {
    palletlabels: state =>{
        return state.all;
    },
};

// Actions
const actions = {
    getAll: async ({context}) => {
        let { data } = await axios.get(apiUrl);
        context.commit('SET_ALL', data);
    },
    update(context, data, id){
        return new Promise((resolve, reject) => {
            axios
                .post(apiUrl + '/' + id, data)
                .then(response => {
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                })
        })
    },
    delete(context, id){
        return new Promise((resolve, reject) => {
            axios
                .delete(apiUrl + '/' + id)
                .then(response => {
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                })
        })
    }
};

// Mutations
const mutations = {
    setAll: (state, payload) =>{
        state.palletLabels = payload
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}


