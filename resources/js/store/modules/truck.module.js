import { TruckService, TruckerService } from "../../common/api.service";

// action names
const FETCH_START = "setTruckLoading";
const FETCH_END =  "resetTruckLoading";

// mutation names
const SET_TRUCK = "setTruck";
const SET_TRUCKS = "setAllTrucks";
const SET_TRUCKERS = "setAllTruckers";
const SET_TRUCKER = "setTrucker";


// Initial State
const state  = {
    trucks: {},
    truck: [],
    trucker: [],
    truckers: {},
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
    truckers(state) {
        return state.truckers;
    },
    trucker(state) {
        return state.trucker
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
    truckerById: (state) => (id) => {
        return state.truckers.find(trucker => trucker.id === id)
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

    async getAllTruckers(context){
        context.commit(FETCH_START);
        return TruckerService.getAll()
            .then(({ data }) => {
                context.commit(SET_TRUCKERS, data.data);
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

    //get single trucker
    async getTrucker(context, truckSlug){
        if(state.trucker.id === truckSlug){
            return;
        }

        context.commit(FETCH_START);
        return TruckerService.get(truckSlug)
            .then(({ data }) => {
                context.commit(SET_TRUCKER, data.data);
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
    },
    [SET_TRUCKERS](state, truckers){
        state.truckers = truckers;
    },
    [SET_TRUCKER](state, trucker){
        state.trucker = trucker;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
