import ApiService from "../common/api.service";
import auth from "../router/routes/auth";
import jwtService from "../common/jwt.service";
import stringifyObjectValues from "bootstrap-vue/esm/components/table/helpers/stringify-object-values";

var farmerIdH = null;
const AccessControl = {
    router(store, router) {
        router.beforeEach((to, from, next) => {
            const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
            const requiresRoles = to.meta.requiresRoles;
            // console.log(requiresRoles);
            const farmerId =   jwtService.getToken('farmer');

            let authUser = [];
            if (store.getters.authUser.uid !== undefined) {
                authUser = store.getters.authUser;
                store.dispatch("checkAuth");
                // console.log('user=' + authUser.lastName + ' to=' + to.name + ' path=' + to.path + ' auth=' + requiresAuth + ' requiredRoles=' + requiresRoles + " userRoles= ");
                authUser.roles.forEach(item => {
                    // console.log("Right: " + item.id +  " " + item.name)
                })
            }
            // console.log("dit is de juiste accesscontrol")
            // console.log(authUser);
            // console.log(to.path);
            // console.log(requiresAuth);
            // console.log(authUser.uid);
            if (requiresAuth && authUser.uid === undefined) {
                console.log('not logged in');
                next('/auth/login');
            } else if ((to.path === '/auth/login' || to.path === '/') && authUser.uid) {
                // console.log(authUser);
                if(authUser.roles[0].name === "Admin"){
                    // console.log('already logged in admin');
                    next("/admin")
                }
                if(authUser.roles[0].name === "Moderator"){
                    // console.log('already logged in Moderator');
                    next("/admin")
                }
                if(authUser.roles[0].name === "Logistics"){
                    // console.log('already logged in Logistics');
                    next("/logistics")
                }
                if(authUser.roles[0].name === "Planning"){
                    // console.log('already logged in Planning');
                    next("/planner")
                }
                if(authUser.roles[0].name === "Production"){
                    // console.log('already logged in Production');
                    next("/production")
                }
                if(authUser.roles[0].name === "Farmer"){
                    // console.log('alreaedy logged in Farmer');
                    next("/farmer")
                }
                if(authUser.roles[0].name === "Trucker"){
                    // console.log('already logged in Logistics');
                    next("/trucker")
                }

                // console.log('already logged in');
                // next();
            } else if (requiresRoles && authUser) {
                if (this.hasRight(requiresRoles, authUser)) {
                    // console.log('authorized');
                    next()
                } else {
                    store.dispatch('logout');
                    // console.log('unauthorized');
                    next('/auth/login')
                }
            }else{
                next()
            }
        });
        axios.interceptors.response.use(null, (error) =>{
            if(error.response.status === 401){
                store.dispatch('logout');
                router.push('/auth/login');
            }
            if (error.response.status === 403){
                router.push('/auth/login');
            }

            return Promise.reject(error);
        });
    },
    hasRight(requiresRoles, authUser) {
        let check = false;
        // console.log(authUser);

        requiresRoles.forEach(role =>{
            if(role === authUser.roles[0].id){
                check = true
            }
        })

        // authUser.roles.forEach((item) => {
        //     requiresRoles.forEach(role =>{
        //         if(role === item.id){
        //             check = true
        //         }
        //     })
        //     // if (requiresRoles.hasOwnProperty(item.id)) {
        //     //     check = true
        //     // }
        // });
        return check
    },
};
//             const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
//             const requiresRoles = to.meta.requiresRoles;
//             const farmerId =  jwtService.getToken('authFarmer');
//
//             let authUser = null;
//             if (store.getters.authUser !== undefined || store.getters.authUser !== null) {
//                 authUser = store.getters.authUser;
//                 store.dispatch("checkAuth");
//                 console.log('user=' + authUser.lastName + ' to=' + to.name + ' path=' + to.path + ' auth=' + requiresAuth + ' requiredRoles=' + requiresRoles + " userRoles= ");
//             }
//
//             //console.log(authUser);
//             //console.log(authUser.length)
//             if(requiresAuth && (authUser === undefined || authUser === null || authUser.uid !== null || authUser.length !== 0)){
//                 console.log("tom")
//                 console.log(authUser)
//             }
//             console.log("check:  "+ (requiresAuth && (authUser === undefined || authUser === null || authUser.uid !== null || authUser.length !== 0)));
//             console.log("====");
//             if (requiresAuth && (authUser === undefined || authUser === null || authUser.uid !== null || authUser.length !== 0)){
//                 console.log('not logged in');
//                 next('/auth/login');
//             } else if (to.path === '/auth/login' && authUser.length !== 0) {
//                 console.log('already logged in');
//                 next('/');
//             } else if (requiresRoles && authUser) {
//                 if (this.hasRight(requiresRoles, authUser)) {
//                     console.log('authorized');
//                     next()
//                 } else {
//                     console.log('unauthorized');
//                     next('/')
//                 }
//             } else {
//                 console.log("No auth required");
//                 next()
//             }
//         });
//         // axios.interceptors.response.use(null, (error) => {
//         //     if (error.response.status === 401) {
//         //         store.dispatch('logout');
//         //         router.push('/');
//         //     }
//         //     if (error.response.status === 403) {
//         //         router.push('/');
//         //     }
//         //
//         //     return Promise.reject(error);
//         // });
//
//     },
//     hasRight(requiresRoles, authUser) {
//         let check = false;
//         // console.log(authUser);
//         // authUser.roles.forEach((item) => {
//         //     requiresRoles.forEach(role => {
//         //         if (role === item.id) {
//         //             check = true
//         //         }
//         //     })
//         //     // if (requiresRoles.hasOwnProperty(item.id)) {
//         //     //     check = true
//         //     // }
//         // });
//         return check
//     }
// };
//     const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
//     const requiresRoles = to.meta.requiresRoles;
//     // const farmerIdH = null;
//     const farmerId =   jwtService.getToken('farmer');
//
//     let authUser = [];
//     if (store.getters.authUser.id !== undefined) {
//         authUser = store.getters.authUser;
//         store.dispatch("checkAuth");
//         // console.log('user=' + authUser.lastName + ' to=' + to.name + ' path=' + to.path + ' auth=' + requiresAuth + ' requiredRoles=' + requiresRoles + " userRoles= ");
//         authUser.roles.forEach(item => {
//             // console.log("Right: " + item.id +  " " + item.name)
//         })
//     }
//
//     if (requiresAuth && authUser.id === undefined) {
//         // console.log('not logged in');
//         next('/auth/login');
//     } else if (to.path === '/auth/login' && authUser.id) {
//         // console.log('already logged in');
//         next('/');
//     } else if (requiresRoles && authUser) {
//         if (this.hasRight(requiresRoles, authUser)) {
//             // console.log('authorized');
//             next()
//         } else {
//             // console.log('unauthorized');
//             next('/')
//         }
//     }else{
//         next()
//     }
// });
// axios.interceptors.response.use(null, (error) =>{
//     if(error.response.status === 401){
//         store.dispatch('logout');
//         router.push('/');
//     }
//     if (error.response.status === 403){
//         router.push('/');
//     }
//
//     return Promise.reject(error);
// });
//
//     },
//     hasRight(requiresRoles, authUser) {
//         let check = false;
//         // console.log(authUser);
//         authUser.roles.forEach((item) => {
//             requiresRoles.forEach(role =>{
//                 if(role === item.id){
//                     check = true
//                 }
//             })
//             // if (requiresRoles.hasOwnProperty(item.id)) {
//             //     check = true
//             // }
//         });
//         return check
//     }
// };
export default AccessControl;
