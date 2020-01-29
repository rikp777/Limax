import { FarmerService } from "../../common/api.service";
import jwtService from "../../common/jwt.service";
import app from "../../app";

// action names
const FETCH_START = "setFarmerLoading";
const FETCH_END =  "resetFarmerLoading";

// mutation names
const SET_FARMER = "setFarmer";
const SET_FARMERS = "setAllFarmers";


// Initial State
const state  = {
    farmers: {},
    farmer: [],
    isLoading: true,
    farmersCount: 0,
};

// Getters
export const getters = {
    farmers(state) {
        return state.farmers;
    },
    farmer(state) {
        return state.farmer
    },
    farmersCount(state) {
        return state.farmersCount
    },
    farmerIsLoading(state) {
        return state.isLoading
    },


    farmerById: (state) => (id) => {
        return state.farmers.find(farmer => farmer.id === id)
    },
    farmerByName: (state) => (name) => {
        return state.farmers.find(farmer => farmer.name === name)
    },
};
// Actions
export const actions = {
    setFarmer({ commit }, payload){
        commit('changeFarmer', payload)
    },
    //get all articles
    async getAllFarmers(context){
        context.commit(FETCH_START);
        return FarmerService.getAll()
            .then(({ data }) => {
                context.commit(SET_FARMERS, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single article
    getFarmer(context, farmerSlug){
        if(state.farmer.id === farmerSlug){
            return;
        }

        context.commit(FETCH_START);
        return FarmerService.get(farmerSlug)
            .then(({ data }) => {
                // console.log(data);
                context.commit(SET_FARMER, data.data);
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

};

// Mutations
export const mutations = {
    [FETCH_START](state) {
        state.isLoading = true;
    },
    [FETCH_END](state) {
        state.isLoading = false;
    },
    [SET_FARMERS](state, farmers){
        state.farmers = farmers;
        state.farmersCount = farmers.length;
    },
    [SET_FARMER](state, farmer){
        state.farmer = farmer;
    },
    changeFarmer(state, payload){
        jwtService.saveToken('authFarmer', payload)
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
