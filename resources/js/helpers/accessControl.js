import ApiService from "../common/api.service";
import auth from "../router/routes/auth";


const AccessControl = {
    router(store, router) {
        router.beforeEach((to, from, next) => {
            const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
            const requiresRoles = to.meta.requiresRoles;

            let authUser = [];
            if (store.getters.authUser.id !== undefined) {
                authUser = store.getters.authUser;
                store.dispatch("checkAuth");
                console.log('user=' + authUser.lastName + ' to=' + to.name + ' path=' + to.path + ' auth=' + requiresAuth + ' roles=' + requiresRoles)
            }

            if (requiresAuth && authUser.id === undefined) {
                console.log('not logged in');
                next('/auth/login');
            } else if (to.path === '/auth/login' && authUser.id) {
                console.log('already logged in');
                next('/');
            } else if (requiresRoles && authUser) {
                if (this.hasRight(requiresRoles, authUser)) {
                    console.log('authorized');
                    next();
                } else {
                    console.log('unauthorized');
                    next('/')
                }
            }else{
                next()
            }
        });
        axios.interceptors.response.use(null, (error) =>{
            if(error.response.status === 401){
                store.dispatch('logout');
                router.push('/');
            }
            if (error.response.status === 403){
                router.push('/');
            }

            return Promise.reject(error);
        });
    },
    hasRight(requiresRoles, authUser) {
        let check = false;
        console.log(authUser);
        authUser.roles.forEach((item) => {
            if (requiresRoles.hasOwnProperty(item.id)) {
                check = true
            }
        });
        return check
    },
};
export default AccessControl;
