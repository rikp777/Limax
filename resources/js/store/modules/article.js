//api url
const apiUrl = '/api/article';

// Initial State
const state = {
    articles: [],
};

// Getters
const getters = {
    getAll(state) {
        return state.articles;
    },
    getById: (state) => (id) => {
        return state.articles.find(article => article.id === id);
    },
    getByName: (state) => (name) => {
        return state.articles.match(name);
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
        state.articles = payload
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}