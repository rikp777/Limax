import { LogisticService } from "../../common/api.service";

// action names
const FETCH_START = "setLogisticsLoading";
const FETCH_END = "resetLogisticsLoading";


// mutation names
const SET_LOGISTIC = "setLogistic";
const SET_LOGISTICS= "setAllLogistics";

// Initial State
const state = {
    logistics: {},
    logistic: [],
    calculation: [],
    isLoading: true,
    logisticsCount: 0,
};

// Getters
const getters = {
    logistics(state){
        return state.logistics;
    },
    logistic(state){
        return state.logistic;
    },
    logisticsCount(state) {
        return state.logisticsCount
    },
    logisticIsLoading(state) {
        return state.isLoading
    },

    // calculation(state){
    //     return state.calculation
    // },


    logisticById: (state) => (id) => {
        return state.logistics.find(logistic => logistic.id === id)
    },
    logisticByName: (state) => (name) => {
        return state.logistics.find(logistic => logistic.name === name)
    },

};

// Actions
const actions = {
    //get all logistics
    async getAllLogistics(context){
        context.commit(FETCH_START);
        return LogisticService.getAll()
            .then(({ data }) => {
                // console.log(data);
                context.commit(SET_LOGISTICS, data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single cell
    async getLogistic(context, logisticSlug) {
        // if (state.logistics.id === logisticSlug) {
        //     return;
        // }
        console.log(logisticSlug);
        context.commit(FETCH_START);
        return LogisticService.get(logisticSlug)
            .then(({data}) => {
                context.commit(SET_LOGISTIC, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

    // //create cell
    // createReport(context) {
    //     return ReportService.create()
    //         .then(({data}) => {
    //             // console.log(data.data);
    //             context.commit(SET_REPORT, data.data);
    //         }).catch( (error) => {
    //             throw error
    //         })
    // },
    // updateCell(context, payload) {
    //     return ReportService.update(payload.id, payload)
    //         .then(({data}) => {
    //             // console.log(data);
    //             context.commit(SET_REPORT, data);
    //         }).catch( (error) => {
    //             throw error
    //         })
    // },
};

// Mutations
const mutations = {
    [FETCH_START](state) {
        state.isLoading = true;
    },
    [FETCH_END](state) {
        state.isLoading = false;
    },
    [SET_LOGISTICS](state, logistics){
        state.logistics = logistics;
        state.logisticsCount = logistics.length;
    },
    [SET_LOGISTIC](state, logistic){
        state.logistic = logistic;
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
