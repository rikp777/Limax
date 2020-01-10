import {PalletLabelService, UserService} from "../../common/api.service";
import user from "../../router/routes/user";


// action names
const FETCH_START = "setUserLoading";
const FETCH_END =  "resetUserLoading";

// mutation names
const SET_USER = "setUser";
const SET_USERS = "setUsers";


// Initial State
const state = {
    all: [],
    users: {},
    user: [],
    isLoading: true,
    userCount: 0,
};

// Getters
const getters = {
    all(state){
        return state.all;
    },
    user(state) {
        return state.user;
    },
    users(state) {
        return state.users;
    },
    userById: (state) => (id) => {
        let user = state.user.find(user => user.id === id);
        if(user) {
            return user;
        }
        this.getUser(id);

        return state.user;

    }
};

// Actions
const actions = {

    async getAllUsers(context){
        context.commit(FETCH_START);
        return UserService.getAll()
            .then(({ data }) => {
                // console.log(data.data);
                context.commit(SET_USERS, data.data);
                context.commit(FETCH_END);
                // console.log(state.palletLabels);
            })
            .catch(error => {
                throw new Error(error)
            })
    },
    getAllByPage(context, page) {
            UserService.getByParam('?page=' + page)
            .then((response) => {
                // console.log(response.data);
                context.commit('userUpdate', response.data);
            })
    },
    //create user
    createUser(context, payload) {
        return UserService.create(payload)
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_USER, data.data);
            }).catch( (error) => {
                throw error
            })
    },

    updateUser(context, payload) {
        return UserService.update(payload.id, payload)
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_USER, data.data);
            }).catch( (error) => {
                throw error
            })
    },

    //delete user
    deleteUser(context, userSlug) {
        return UserService.delete(userSlug)
    },
    // create(context, data) {
    //     // console.log(data.password);
    //     return new Promise((resolve, reject) => {
    //         axios.post('/user', {
    //             first_name: data.first_name,
    //             last_name: data.last_name,
    //             email: data.email,
    //             password: data.password,
    //         })
    //             .then(response => {
    //                 resolve(response)
    //             })
    //             .catch(error => {
    //                 reject(error)
    //             })
    //     })
    // },

//get single palletLabels
    getUser(context, userSlug) {
        if (state.user.id === userSlug) {
            return;
        }
        context.commit(FETCH_START);
        return UserService.get(userSlug)
            .then(({data}) => {
                // console.log(data);
                context.commit(SET_USER, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },
};

// Mutations
export const mutations = {
    userUpdate(state, payload){
        state.all = payload
    },
    [FETCH_START](state) {
        state.isLoading = true;
    },
    [FETCH_END](state) {
        state.isLoading = false;
    },
    [SET_USERS](state, users){
        //console.log(palletLabels);
        state.users = users;
        state.usersCount = users.length;
    },
    [SET_USER](state, user){
        state.user = user;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
