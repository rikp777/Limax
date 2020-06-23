import {articlegroupService} from "../../common/api.service";

// action names
const FETCH_START = "setArticlegroupLoading";
const FETCH_END =  "resetArticlegroupLoading";

// mutation names
const SET_ARTICLEGROUP = "setArticlegroupType";
const SET_ARTICLEGROUPS = "setAllArticlegroups";


// Initial State
const state = {
    articlegroups: {},
    articlegroup: [],
    isLoading: true,
    articlegroupsCount: 0,
};

// Getters
const getters = {
    articlegroups(state) {
        return state.articlegroups;
    },
    articlegroup(state) {
        return state.articlegroup;
    },
    articlegroupsCount(state) {
        return state.articlegroupsCount;
    },
    isLoading(state) {
        return state.isLoading;
    },


    articlegroupById: (state) => (id) => {
        return state.articlegroups.find(articlegroup => articlegroup.id === id)
    },
    articlegroupByName: (state) => (name) => {
        return state.articlegroups.find(articlegroup => articlegroup.name === name)
    },
};

// Actions
const actions = {

    //get all articlegroups
    async getAllArticlegroup(context){
        context.commit(FETCH_START);
        return articlegroupService.getAll()
            .then(({ data }) => {
                context.commit(SET_ARTICLEGROUPS, data.data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single articlegroup
    async getArticlegroup(context, articlegroupSlug, prevarticlegroup){
        context.commit(FETCH_START);
        if(prevarticlegroup !== undefined){
            return context.commit(SET_ARTICLEGROUP, prevarticlegroup);
        }
        const { data } = await articlegroupService.get(articlegroupSlug);
        context.commit(SET_ARTICLEGROUP, data);
        return data;
    },
};

// Mutations
const mutations = {
    [FETCH_START](state){
        state.isLoading = true;
    },
    [SET_ARTICLEGROUPS](state, articlegroups) {
        state.articlegroups = articlegroups;
        state.articlegroupsCount = articlegroups.length;
        state.isLoading = false;
    },
    [SET_ARTICLEGROUP](state, articlegroup){
        state.articlegroup = articlegroup;
        state.isLoading = false;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
