import { TransportService } from "../../common/api.service";

// action names
const FETCH_START = "setTransportLoading";
const FETCH_END = "resetTransportLoading";


// mutation names
const SET_TRANSPORT = "setTransport";
const SET_TRANSPORTS= "setAllTransports";

// Initial State
const state = {
    transports: {},
    transport: [],
    isLoading: true,
    transportsCount: 0,
};

// Getters
const getters = {
    transports(state){
        return state.transports;
    },
    transport(state){
        return state.transport;
    },
    transportsCount(state) {
        return state.transportsCount
    },
    TransportIsLoading(state) {
        return state.isLoading
    },

};

// Actions
const actions = {
    async getAllTransports(context){
        context.commit(FETCH_START);
        return TransportService.getAll()
            .then(({ data }) => {
                // console.log(data);
                context.commit(SET_TRANSPORTS, data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single cell
    async getTransport(context, transportSlug) {
        if (state.transports.id === transportSlug) {
            return;
        }
        // console.log(transportSlug);
        context.commit(FETCH_START);
        return TransportService.get(transportSlug)
            .then(({data}) => {
                context.commit(SET_TRANSPORT, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
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
    [SET_TRANSPORTS](state, transports){
        state.transports = transports;
        state.transportsCount = transports.length;
    },
    [SET_TRANSPORT](state, transport){
        state.transport = transport;
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
