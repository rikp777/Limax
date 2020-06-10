import {sortService} from "../../common/api.service";

// action names
const FETCH_START = "setSortLoading";
const FETCH_END =  "resetSortLoading";

// mutation names
const SET_SORT = "setSortType";
const SET_SORTS = "setAllSorts";




// Initial State
const state = {
    sorts: {},
    sort: [],
    isLoading: true,
    sortsCount: 0,
};

// Getters
const getters = {
    sorts(state) {
        return state.sorts;
    },
    sort(state) {
        return state.sort;
    },
    sortsCount(state) {
        return state.sortsCount;
    },
    isLoading(state) {
        return state.isLoading;
    },


    sortById: (state) => (id) => {
        return state.sorts.find(sort => sort.id === id)
    },
    sortByName: (state) => (name) => {
        return state.sorts.find(sort => sort.name === name)
    },
};

// Actions
const actions = {

    //get all sorts
    async getAllSorts(context){
        context.commit(FETCH_START);
        return sortService.getAll()
            .then(({ data }) => {
                context.commit(SET_SORTS, data.data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single sort
    async getSort(context, sortSlug, prevsort){
        context.commit(FETCH_START);
        if(prevsort !== undefined){
            return context.commit(SET_SORT, prevsort);
        }
        const { data } = await sortService.get(sortSlug);
        context.commit(SET_SORT, data);
        return data;
    },
};

// Mutations
const mutations = {
    [FETCH_START](state){
        state.isLoading = true;
    },
    [SET_SORTS](state, sorts) {
        state.sorts = sorts;
        state.sortsCount = sorts.length;
        state.isLoading = false;
    },
    [SET_SORT](state, sort){
        state.sort = sort;
        state.isLoading = false;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
