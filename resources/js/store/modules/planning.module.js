import { PlanningService } from "../../common/api.service";

// action names
const FETCH_START = "setPlanningLoading";
const FETCH_END = "resetPlanningLoading";


// mutation names
const SET_PLANNING = "setPlanning";
const SET_PLANNINGS= "setAllPlannings";

// Initial State
const state = {
    plannings: {},
    planning: [],
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
    planningsCount(state) {
        return state.planningsCount
    },
    planningIsLoading(state) {
        return state.isLoading
    },

    calculation(state){
        return state.calculation
    },


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

    //get single cell
    async getPlanning(context, planningSlug) {
        if (state.plannings.id === planningSlug) {
            return;
        }

        context.commit(FETCH_START);
        return PlanningService.get(planningSlug)
            .then(({data}) => {
                // console.log(data);
                context.commit(SET_PLANNING, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

    //create cell
    createPlanning(context) {
        return PlanningService.create()
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
