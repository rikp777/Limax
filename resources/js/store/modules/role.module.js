import {ArticleService, RoleService, PalletLabelService} from "../../common/api.service";

// action names
const FETCH_START = "setRoleLoading";
const FETCH_END = "resetRoleLoading";


// mutation names
const SET_ROLE = "setRole";
const SET_ROLES = "setAllRoles";

// Initial State
const state = {
    roles: {},
    role: [],
    calculation: [],
    isLoading: true,
    rolesCount: 0,
};

// Getters
const getters = {
    roles(state){
        return state.roles;
    },
    role(state){
        return state.role;
    },
    rolesCount(state) {
        return state.rolesCount
    },
    roleIsLoading(state) {
        return state.isLoading
    },

    calculation(state){
        return state.calculation
    },


    roleById: (state) => (id) => {
        return state.roles.find(role => role.id === id)
    },
    roleByName: (state) => (name) => {
        return state.roles.find(role => role.name === name)
    },

};

// Actions
const actions = {
    //get all Roles
    async getAllRoles(context){
        context.commit(FETCH_START);
        return RoleService.getAll()
            .then(({ data }) => {
                console.log(data);
                context.commit(SET_ROLES, data.data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single Role
    async getRole(context, roleSlug) {
        if (state.roles.id === roleSlug) {
            return;
        }

        context.commit(FETCH_START);
        return RoleService.get(roleSlug)
            .then(({data}) => {
                context.commit(SET_ROLE, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

    //create Role
    createRole(context) {
        return RoleService.create()
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_ROLE, data.data);
            }).catch( (error) => {
                throw error
            })
    },
    updateRole(context, payload) {
        return RoleService.update(payload.id, payload)
            .then(({data}) => {
                console.log(data);
                context.commit(SET_ROLE, data);
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
    [SET_ROLES](state, roles){
        state.roles = roles;
        state.rolesCount = roles.length;
    },
    [SET_ROLE](state, role){
        state.role = role;
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
