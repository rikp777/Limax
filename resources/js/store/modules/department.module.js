import {ArticleService, DepartmentService, PalletLabelService} from "../../common/api.service";

// action names
const FETCH_START = "setDepartmentLoading";
const FETCH_END = "resetDepartmentLoading";


// mutation names
const SET_DEPARTMENT = "setDepartment";
const SET_DEPARTMENTS = "setAllDepartments";

// Initial State
const state = {
    departments: {},
    department: [],
    calculation: [],
    isLoading: true,
    departmentsCount: 0,
};

// Getters
const getters = {
    departments(state){
        return state.departments;
    },
    department(state){
        return state.department;
    },
    departmentsCount(state) {
        return state.departmentsCount
    },
    departmentIsLoading(state) {
        return state.isLoading
    },

    calculation(state){
        return state.calculation
    },


    departmentById: (state) => (id) => {
        return state.departments.find(department => department.id === id)
    },
    departmentByName: (state) => (name) => {
        return state.departments.find(department => department.name === name)
    },

};

// Actions
const actions = {
    //get all departments
    async getAllDepartments(context){
        context.commit(FETCH_START);
        return DepartmentService.getAll()
            .then(({ data }) => {
                console.log(data);
                context.commit(SET_DEPARTMENTS, data.data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single department
    async getDepartment(context, departmentSlug) {
        if (state.departments.id === departmentSlug) {
            return;
        }

        context.commit(FETCH_START);
        return DepartmentService.get(departmentSlug)
            .then(({data}) => {
                context.commit(SET_DEPARTMENT, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

    //create department
    createDepartment(context) {
        return DepartmentService.create()
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_DEPARTMENT, data.data);
            }).catch( (error) => {
                throw error
            })
    },
    updateDepartment(context, payload) {
        return DepartmentService.update(payload.id, payload)
            .then(({data}) => {
                console.log(data);
                context.commit(SET_DEPARTMENT, data);
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
    [SET_DEPARTMENTS](state, departments){
        state.departments = departments;
        state.departmentsCount = departments.length;
    },
    [SET_DEPARTMENT](state, department){
        state.department = department;
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
