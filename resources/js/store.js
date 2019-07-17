// import { getLocalUser } from "./helpers/auth";
//
// const user = getLocalUser();
//
// export default {
//     state: {
//         authUser: user,
//         isLoggedIn: !! user,
//         loading: false,
//         auth_error: null,
//         users: []
//     },
//     getters: {
//         isLoading(state){
//             return state.loading;
//         },
//         isLoggedIn(state){
//             return state.isLoggedIn;
//         },
//         authUser(state){
//             return state.authUser
//         },
//         authError(state){
//             return state.auth_error;
//         },
//         users(state){
//             return state.users;
//         },
//     },
//     mutations: {
//         login(state){
//             state.loading = true;
//             state.auth_error = null;
//         },
//         loginSuccess(state, payload){
//             state.auth_error = null;
//             state.isLoggedIn = true;
//             state.loading = false;
//             state.authUser = Object.assign({}, payload.user, {token: payload.access_token});
//
//             localStorage.setItem("user", JSON.stringify(state.authUser));
//         },
//         loginFailed(state, payload){
//             state.loading = false;
//             state.auth_error = payload.error;
//         },
//         logout(state){
//             localStorage.removeItem("user");
//             state.isLoggedIn = false;
//             state.authUser = null;
//             state.users = []
//         },
//         userUpdate(state, payload){
//             state.users = payload
//         }
//     },
//     actions: {
//         login(context){
//             context.commit("login")
//         },
//         getUsers(context){
//             axios.get('/api/user')
//             .then((response) => {
//                 context.commit('userUpdate', response.data);
//             })
//         }
//     },
// }