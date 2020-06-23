import {insetService} from "../../common/api.service";

// action names
const FETCH_START = "setInsetLoading";
const FETCH_END =  "resetInsetLoading";

// mutation names
const SET_INSET = "setInsetType";
const SET_INSETS = "setAllInsets";




// Initial State
const state = {
    insets: {},
    inset: [],
    isLoading: true,
    insetsCount: 0,
};

// Getters
const getters = {
    insets(state) {
        return state.insets;
    },
    inset(state) {
        return state.inset;
    },
    insetsCount(state) {
        return state.insetsCount;
    },
    isLoading(state) {
        return state.isLoading;
    },


    insetById: (state) => (id) => {
        return state.insets.find(inset => inset.id === id)
    },
    insetByName: (state) => (name) => {
        return state.insets.find(inset => inset.name === name)
    },
};

// Actions
const actions = {

    //get all insets
    async getAllInsets(context){
        context.commit(FETCH_START);
        return insetService.getAll()
            .then(({ data }) => {
                context.commit(SET_INSETS, data.data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single Inset
    async getInset(context, insetSlug, previnset){
        context.commit(FETCH_START);
        if(previnset !== undefined){
            return context.commit(SET_INSET, previnset);
        }
        const { data } = await insetService.get(insetSlug);
        context.commit(SET_INSET, data);
        return data;
    },
};

// Mutations
const mutations = {
    [FETCH_START](state){
        state.isLoading = true;
    },
    [SET_INSETS](state, insets) {
        state.insets = insets;
        state.insetsCount = insets.length;
        state.isLoading = false;
    },
    [SET_INSET](state, inset){
        state.inset = inset;
        state.isLoading = false;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
