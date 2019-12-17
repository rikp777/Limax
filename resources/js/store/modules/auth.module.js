import ApiService, { ArticlesService } from "../../common/api.service";
import jwtService from "../../common/jwt.service";

// action names
const FETCH_START = "setAuthLoading";
const FETCH_END = "resetAuthLoading";

// mutation names
const SET_AUTH_USER = "setAuthUser";
const SET_AUTH_ERROR = "setAuthError";
const AUTH_PURGE = "AuthPurge";



//Initial State
const state = {
    errors: null,
    user: [],
    isAuthenticated: !!jwtService.getToken(),
    isLoading: true,
};



// Getters
const getters = {
    authUser(state) {
        return state.user
    },
    isAuthenticated(state){
        return state.isAuthenticated;
    },
    authIsLoading(state){
        return state.isLoading;
    }
};

// Actions
const actions = {
    login(context, credentials){
        return new Promise(resolve => {
            context.commit(FETCH_START);
            ApiService
                .post("login", credentials)
                .then(( response )  => {
                    context.commit(SET_AUTH_USER, response.data);
                    ApiService.setHeader();
                    context.commit(FETCH_END);
                    resolve(response);
                })
                .catch(( error ) => {
                    context.commit(SET_AUTH_ERROR, error);
                });
        });
    },
    logout(context){
        context.commit(AUTH_PURGE)
    },
    checkAuth(context){
        if(jwtService.getToken()){
            ApiService.setHeader();
        }else {
            context.commit(AUTH_PURGE)
        }
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
   [SET_AUTH_ERROR](state, errors){
       state.errors = errors
   },
    [SET_AUTH_USER](state, payload) {
        console.log(payload.user);
       state.isAuthenticated = true;
       state.user = payload.user;
       state.errors = {};
       jwtService.saveToken('user', payload.accessToken);
    },
    [AUTH_PURGE](state){
       state.isAuthenticated = false;
       state.user = [];
       state.errors = {};
       jwtService.destroyToken('user');
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
