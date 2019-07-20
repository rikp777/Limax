// Initial State
const state = {
    articles: [],
    article: ''
};

// Getters
const getters = {
    all(state){
        return state.articles;
    },
    getArticleById: (state) => (id) => {
        return state.articles.find(article => article.id === id);
    },
};

// Actions
const actions = {
    getAll(context){
        axios.get('/api/article')
            .then((response) => {
                context.commit('articlesUpdate', response.data);
            })
    },
};

// Mutations
const mutations = {
    articlesUpdate(state, payload){
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