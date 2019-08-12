import ApiService from "../common/api.service";


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



            if (requiresAuth && !authUser) {
                console.log('not logged in');
                next('/login');
            } else if (to.path === '/login' && authUser) {
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
            } else {
                console.log('no authorization needed');
                next();
            }
        });
        axios.interceptors.response.use(null, (error) =>{
            if(error.response.status === 401){
                store.dispatch('logout');
                router.push('/login');
            }
            if (error.response.status === 403){
                router.push('/');
            }

            return Promise.reject(error);
        });
    },
    hasRight(requiresRoles, authUser) {
        let check = false;
        authUser.roles.forEach((item) => {
            if (requiresRoles.hasOwnProperty(item.id)) {
                check = true
            }
        });
        return check
    },
};
export default AccessControl;
