import {ArticleService, UserService} from "../../common/api.service";

// action names
const FETCH_START = "setArticleLoading";
const FETCH_END =  "resetArticleLoading";

// mutation names
const SET_ARTICLE = "setArticle";
const SET_ARTICLES = "setAllArticles";

// Initial State
const state  = {
    articles: {},
    article: [],
    isLoading: true,
    articlesCount: 0,
};

// Getters
export const getters = {
    articles(state) {
        return state.articles;
    },
    article(state) {
        return state.article
    },
    articlesCount(state) {
        return state.articlesCount
    },
    articleIsLoading(state) {
        return state.isLoading
    },

    articleById: (state) => (id) =>{
        if(state.articles.length) {
           return state.articles.find(article => article.id === id)
        }
    },

    articleByName: (state) => (name) => {
        return state.articles.find(todo => todo.name === name)
    },
};
// Actions
export const actions = {
    //get all articles
    async getAllArticles(context){
        context.commit(FETCH_START);
        return ArticleService.getAll()
            .then(({ data }) => {
                context.commit(SET_ARTICLES, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single article
    async getArticle(context, articleSlug){
        if(state.article.id === articleSlug){
            return;
        }

        context.commit(FETCH_START);
        return ArticleService.get(articleSlug)
            .then(({ data }) => {
                context.commit(SET_ARTICLE, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
        // context.commit(FETCH_START);
        // const { data }  = await ArticlesService.get(articleSlug);
        // context.commit(SET_ARTICLE, data.data);
        // context.commit(FETCH_END);
        // return data;
    },

    //create article
    createArticle(context, payload) {
        console.log(payload);
        return ArticleService.create(payload)
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_ARTICLE, data.data);
            }).catch( (error) => {
                throw error
            })
    },

    //update article
    updateArticle(context, payload) {
        //console.log(payload);
        return ArticleService.update(payload.id, payload)
            .then(({data}) => {
                // console.log(data);
                context.commit(SET_ARTICLE, data.data);
            }).catch( (error) => {
                throw error
            })
    },

    //delete article
    deleteArticle(context, articleSlug) {
        console.log(articleSlug);
        return ArticleService.delete(articleSlug)
    }

};

// Mutations
export const mutations = {
    [FETCH_START](state) {
         state.isLoading = true;
    },
    [FETCH_END](state) {
        state.isLoading = false;
    },
    [SET_ARTICLES](state, articles){
        state.articles = articles;
        state.articlesCount = articles.length;
    },
    [SET_ARTICLE](state, article){
        state.article = article;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
