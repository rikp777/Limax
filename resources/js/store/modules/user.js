
// Initial State
const state = {
    all: []
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
        axios.get('/api/user')
            .then((response) => {
                context.commit('userUpdate', response.data);
            })
    },
    getAllByPage(context, page){
        axios.get('/api/user?page=' + page)
            .then((response) => {
                context.commit('userUpdate', response.data);
            })
    },
    create(context, data){
        //console.log(data.password);
        return new Promise((resolve, reject) => {
            axios.post('/api/user', {
                first_name: data.first_name,
                last_name: data.last_name,
                email: data.email,
                password: data.password,
            })
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
    userUpdate(state, payload){
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
