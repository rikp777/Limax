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
    authUser: jwtService.getToken('authUser') ? JSON.parse(jwtService.getToken('authUser')) : null,
    authUserFarmers: jwtService.getToken('authUser') ?  JSON.parse(jwtService.getToken('authUser')).user.farmers : null,
    isAuthenticated: !!jwtService.getToken(),
    processing: false,
};


// Getters
const getters = {
    authUser: state => state.authUser,
    loginError: state => state.loginError,
    isAuthenticated: state => state.isAuthenticated,
    processing: state => state.processing,
    authUserFarmers: state => state.authUserFarmers
};

// Actions
const actions = {
    login(context, credentials) {
        return new Promise(resolve => {
            context.commit(FETCH_START);
            ApiService
                .post("login", credentials)
                .then((response) => {
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
        const authUser = {
            "token": {
                "accessToken": data.accessToken,
                "tokenType": data.tokenType,
                "expiresAt": data.expiresAt
            },
            "user": data.user
        };
        console.log(authUser);
        jwtService.saveToken('authUser', JSON.stringify(authUser));
        if(authUser.user.farmers){
            jwtService.saveToken('authFarmer', JSON.stringify(authUser.user.farmers[0].uid));
        }
        ApiService.setHeader();


        state.isAuthenticated = true;
        state.authUser = authUser;
        state.loginError = null;
    },
    [AUTH_PURGE](state) {
        console.log("Destroy all states");
        jwtService.destroyToken('authUser');
        jwtService.destroyToken('authFarmer');

        state.isAuthenticated = false;
        state.authUser = [];
        state.loginError = null;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
