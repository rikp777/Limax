import { ReportService } from "../../common/api.service";

// action names
const FETCH_START = "setReportLoading";
const FETCH_END = "resetReportLoading";


// mutation names
const SET_REPORT = "setReport";
const SET_REPORTS= "setAllReports";

// Initial State
const state = {
    reports: {},
    report: [],
    calculation: [],
    isLoading: true,
    reportsCount: 0,
};

// Getters
const getters = {
    reports(state){
        return state.reports;
    },
    report(state){
        return state.report;
    },
    reportsCount(state) {
        return state.reportsCount
    },
    reportIsLoading(state) {
        return state.isLoading
    },

    calculation(state){
        return state.calculation
    },


    reportById: (state) => (id) => {
        return state.reports.find(report => report.id === id)
    },
    reportByName: (state) => (name) => {
        return state.reports.find(report => report.name === name)
    },

};

// Actions
const actions = {
    //get all reports
    async getAllReports(context){
        context.commit(FETCH_START);
        return ReportService.getAll()
            .then(({ data }) => {
                // console.log(data);
                context.commit(SET_REPORTS, data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single cell
    async getReport(context, reportSlug) {
        if (state.reports.id === reportSlug) {
            return;
        }

        context.commit(FETCH_START);
        return ReportService.get(reportSlug)
            .then(({data}) => {
                context.commit(SET_REPORT, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

    //create cell
    createReport(context) {
        return ReportService.create()
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_REPORT, data.data);
            }).catch( (error) => {
                throw error
            })
    },
    updateCell(context, payload) {
        return ReportService.update(payload.id, payload)
            .then(({data}) => {
                // console.log(data);
                context.commit(SET_REPORT, data);
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
    [SET_REPORTS](state, reports){
        state.reports = reports;
        state.reportsCount = reports.length;
    },
    [SET_REPORT](state, report){
        state.report = report;
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
