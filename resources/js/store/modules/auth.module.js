import ApiService, {ArticlesService} from "../../common/api.service";
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
    loginError: null,
    authUser: [],
    authUserFarmers: [],
    authFarmer: [],
    isAuthenticated: !!jwtService.getToken(),
    processing: false,
};


// Getters
const getters = {
    authUser: state => state.authUser,
    authFarmer: state => state.authFarmer,
    loginError: state => state.loginError,
    isAuthenticated: state => state.isAuthenticated,
    processing: state => state.processing,
    authUserFarmers: state => state.authUserFarmers
};

// Actions
const actions = {
    getAuthUser(context){
        ApiService.get("/authuser")
            .then((response) => {
                context.commit(SET_AUTH_USER, response.data);
            })
            .catch((error) => {
                context.commit(SET_AUTH_ERROR, error);
            });
    },
    login(context, credentials) {
        return new Promise(resolve => {
            context.commit(FETCH_START);
            ApiService
                .post("login", credentials)
                .then((response) => {
                    // console.log(response.data)
                    context.commit(SET_AUTH_USER, response.data);
                    context.commit(FETCH_END);

                    resolve(response);
                })
                .catch((error) => {
                    context.commit(SET_AUTH_ERROR, error);
                });
        });
    },
    logout(context) {
        return new Promise(resolve => {
            context.commit(AUTH_PURGE);
            resolve();
        })
    },
    checkAuth(context) {
        if (jwtService.getToken('authUser')) {
            ApiService.setHeader();
        } else {
            context.commit(AUTH_PURGE)
        }
    },
};

// Mutations
const mutations = {
    [FETCH_START](state) {
        state.processing = true;
    },
    [FETCH_END](state) {
        state.processing = false;
    },
    [SET_AUTH_ERROR](state, errors) {
        state.loginError = errors
    },
    [SET_AUTH_USER](state, data) {
        if(data.user){
            jwtService.saveToken('authToken', JSON.stringify(data.auth.accessToken));
            jwtService.saveToken('authUser', JSON.stringify(data.user.uid));
        }
        if(data.user.farmers){
            if(!jwtService.getToken('authFarmer')){
                jwtService.saveToken('authFarmer', JSON.stringify(data.user.farmers[0].uid));
            }
        }
        ApiService.setHeader();

        state.isAuthenticated = true;
        state.authUser = data.user;
        state.authUserFarmers = data.user.farmers;
        state.authFarmer = data.user.farmers.find(f => f.uid === JSON.parse(jwtService.getToken('authFarmer')));
        state.loginError = null;
    },
    [AUTH_PURGE](state) {
        //console.log("Destroy all states");
        state.isAuthenticated = false;
        state.authUser = [];
        state.loginError = null;
        jwtService.destroyToken('authToken');
        jwtService.destroyToken('authUser');
        jwtService.destroyToken('authFarmer');


    },
    changeAuthFarmer(state, payload){
        state.authFarmer = payload;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
