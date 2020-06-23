import {SortFarmerService} from "../../common/api.service";

// action names
const FETCH_START = "setSortFarmerLoading";
const FETCH_END = "resetSortFarmerLoading";


// mutation names
const SET_SORTFARMER = "setSortFarmer";
const SET_SORTFARMERS = "setAllSortFarmers";

// Initial State
const state = {
    sortfarmers: {},
    sortfarmer: [],
    calculation: [],
    isLoading: true,
    sortfarmersCount: 0,
};

// Getters
const getters = {
    sortfarmers(state){
        return state.sortfarmers;
    },
    sortfarmer(state){
        return state.sortfarmer;
    },
    sortfarmersCount(state) {
        return state.sortfarmersCount
    },
    sortfarmerIsLoading(state) {
        return state.isLoading
    },



    sortfarmerById: (state) => (id) => {
        return state.sortfarmers.find(sortfarmer => sortfarmer.id === id)
    },
    sortfarmerByName: (state) => (name) => {
        return state.sortfarmers.find(sortfarmer => sortfarmer.name === name)
    },

};

// Actions
const actions = {
    async getAllSortFarmers(context){
        context.commit(FETCH_START);
        return SortFarmerService.getAll()
            .then(({ data }) => {
                // console.log(data);
                context.commit(SET_SORTFARMERS, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single Role
    async getSortFarmer(context, sortfarmerSlug) {
        if (state.sortfarmers.id === sortfarmerSlug) {
            return;
        }

        context.commit(FETCH_START);
        return SortFarmerService.get(sortfarmerSlug)
            .then(({data}) => {
                context.commit(SET_SORTFARMER, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

    createSortFarmer(context, payload) {
        return SortFarmerService.create(payload)
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_SORTFARMER, data.data);
            }).catch( (error) => {
                throw error
            })
    },

    updateSortFarmer(context, payload) {
        // console.log(payload.farmerid);
        return SortFarmerService.update(payload, payload)
            .then(({data}) => {
                // console.log(data);
                context.commit(SET_SORTFARMER, data);
            }).catch( (error) => {
                throw error
            })
    },
};

// Mutations
const mutations = {
    [FETCH_START](state) {
        state.isLoading = true;
    },
    [FETCH_END](state) {
        state.isLoading = false;
    },
    [SET_SORTFARMERS](state, sortfarmers){
        state.sortfarmers = sortfarmers;
        state.sortfarmersCount = sortfarmers.length;
    },
    [SET_SORTFARMER](state, sortfarmer){
        state.sortfarmer = sortfarmer;
    },
    setCalculation(state, calculation){
        //console.log(calculation);
        state.calculation = calculation
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
