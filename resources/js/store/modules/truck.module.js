import { TruckService } from "../../common/api.service";

// action names
const FETCH_START = "setTruckLoading";
const FETCH_END =  "resetTruckLoading";

// mutation names
const SET_TRUCK = "setTruck";
const SET_TRUCKS = "setAllTrucks";


// Initial State
const state  = {
    trucks: {},
    truck: [],
    isLoading: true,
    trucksCount: 0,
};

// Getters
export const getters = {
    trucks(state) {
        return state.trucks;
    },
    truck(state) {
        return state.truck
    },
    trucksCount(state) {
        return state.trucksCount
    },
    truckIsLoading(state) {
        return state.isLoading
    },


    truckById: (state) => (id) => {
        return state.trucks.find(truck => truck.id === id)
    },
    truckByName: (state) => (name) => {
        return state.trucks.find(truck => truck.name === name)
    },
};
// Actions
export const actions = {

    //get all trucks
    async getAllTrucks(context){
        context.commit(FETCH_START);
        return TruckService.getAll()
            .then(({ data }) => {
                context.commit(SET_TRUCKS, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single truck
    async getTruck(context, truckSlug){
        if(state.truck.id === truckSlug){
            return;
        }

        context.commit(FETCH_START);
        return TruckService.get(truckSlug)
            .then(({ data }) => {
                context.commit(SET_TRUCK, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
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
    [SET_TRUCKS](state, trucks){
        state.trucks = trucks;
        state.trucksCount = trucks.length;
    },
    [SET_TRUCK](state, truck){
        state.truck = truck;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
