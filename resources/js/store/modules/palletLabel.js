const apiUrl = '/api/palletlabel';
// Initial State
const state = {
    palletLabels: [],
    palletLabel: '',
};

// Getters
const getters = {
    getAll(state){
        return state.all;
    },
    getById: (state) => (id) => {
        let result = state.palletLabels.find(palletLabel => palletLabel.id === id);
        if(result){
            return result;
        }
        return this.palletLabel;
    },
};

// Actions
const actions = {
    getAll(context){
        return new Promise((resolve, reject) => {
            axios.get(apiUrl)
                .then((response) => {
                    console.log(response);
                    resolve(response);
                    context.commit('setAll', response.data);
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
                    context.commit('setSingle', response.data.data);
                })
                .catch((error) => {
                    reject(error);
                })
        })
    },
};

// Mutations
const mutations = {
    setAll(state, payload){
        state.palletLabels = payload
    },
    setSingle(state, payload){
        state.palletLabel = payload;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}


