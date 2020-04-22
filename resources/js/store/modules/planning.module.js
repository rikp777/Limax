import { PlanningService, PlanningTotalService } from "../../common/api.service";

// action names
const FETCH_START = "setPlanningLoading";
const FETCH_END = "resetPlanningLoading";


// mutation names
const SET_PLANNING = "setPlanning";
const SET_PLANNINGTOTAL = "setPlanningTotal";
const SET_PLANNINGS= "setAllPlannings";

// Initial State
const state = {
    plannings: {},
    planning: [],
    planningTotal: [],
    calculation: [],
    isLoading: true,
    planningsCount: 0,
};

// Getters
const getters = {
    plannings(state){
        return state.plannings;
    },
    planning(state){
        return state.planning;
    },
    planningTotal(state){
        return state.planningTotal;
    },
    planningsCount(state) {
        return state.planningsCount
    },
    planningIsLoading(state) {
        return state.isLoading
    },

    // calculation(state){
    //     return state.calculation
    // },


    planningById: (state) => (id) => {
        return state.plannings.find(planning => planning.id === id)
    },
    planningByName: (state) => (name) => {
        return state.plannings.find(planning => planning.name === name)
    },

};

// Actions
const actions = {
    //get all reports
    async getAllPlannings(context){
        context.commit(FETCH_START);
        return PlanningService.getAll()
            .then(({ data }) => {
                // console.log(data);
                context.commit(SET_PLANNINGS, data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    async getPlanningTotal(context){
        context.commit(FETCH_START);
        return PlanningTotalService.getAll()
            .then(({ data }) => {
                context.commit(SET_PLANNINGTOTAL, data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single cell
    async getPlanning(context, planningSlug) {
        if (state.plannings.id === planningSlug) {
            return;
        }

        context.commit(FETCH_START);
        return PlanningService.get(planningSlug)
            .then(({data}) => {
                // console.log(data);
                context.commit(SET_PLANNING, data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

    //create cell
    createPlanning(context, payload) {
        //console.log(payload)
        return PlanningService.create(payload)
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_PLANNING, data.data);
            }).catch( (error) => {
                throw error
            })
    },
    updatePlanning(context, payload) {
        return PlanningService.update(payload.id, payload)
            .then(({data}) => {
                // console.log(data);
                context.commit(SET_PLANNING, data);
            }).catch( (error) => {
                throw error
            })
    },
    updatePlanningStatus(context, payload) {
        return PlanningService.update(payload.cell_id, payload)
            .then(({data}) => {
                // console.log(data);
                context.commit(SET_PLANNING, data);
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
    [SET_PLANNINGS](state, plannings){
        state.plannings = plannings;
        state.planningsCount = plannings.length;
    },
    [SET_PLANNING](state, planning){
        state.planning = planning;
    },
    [SET_PLANNINGTOTAL](state, planningTotal){
        state.planningTotal = planningTotal;
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
