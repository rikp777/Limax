import {caskService} from "../../common/api.service";

// action names
const FETCH_START = "setCaskLoading";
const FETCH_END =  "resetCaskLoading";

// mutation names
const SET_CASK = "setCaskType";
const SET_CASKS = "setAllCasks";




// Initial State
const state = {
    casks: {},
    cask: [],
    isLoading: true,
    casksCount: 0,
};

// Getters
const getters = {
    casks(state) {
        return state.casks;
    },
    cask(state) {
        return state.cask;
    },
    casksCount(state) {
        return state.casksCount;
    },
    isLoading(state) {
        return state.isLoading;
    },


    caskById: (state) => (id) => {
        return state.casks.find(cask => cask.id === id)
    },
    caskByName: (state) => (name) => {
        return state.casks.find(cask => cask.name === name)
    },
};

// Actions
const actions = {

    //get all casks
    async getAllCasks(context){
        context.commit(FETCH_START);
        return caskService.getAll()
            .then(({ data }) => {
                context.commit(SET_CASKS, data.data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single article
    async getCask(context, caskSlug, prevcask){
        context.commit(FETCH_START);
        if(prevcask !== undefined){
            return context.commit(SET_CASK, prevcask);
        }
        const { data } = await caskService.get(caskSlug);
        context.commit(SET_CASK, data);
        return data;
    },
};

// Mutations
const mutations = {
    [FETCH_START](state){
        state.isLoading = true;
    },
    [SET_CASKS](state, casks) {
        state.casks = casks;
        state.casksCount = casks.length;
        state.isLoading = false;
    },
    [SET_CASK](state, cask){
        state.cask = cask;
        state.isLoading = false;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
