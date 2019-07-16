

export function initialize(store, router) {
    router.beforeEach((to, from, next) => {
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        const requiresRoles = to.meta.requiresRoles;
        const authUser = store.state.authUser;

        if(requiresAuth && !authUser){
            next('/login');
        } else if(to.path === '/login' && authUser){
            next('/');
        } else if(requiresRoles){
            if(hasRight(requiresRoles, authUser)){
                console.log('authorized');
                next();
            }else{
                console.log('unauthorized');
                next('/')
            }
        } else{
            next();
        }
        if (store.getters.authUser) {
            setAuthorization(authUser.token);
        }
    });

    function hasRight(requiresRoles, authUser){
        let check = false;
        authUser.roles.forEach((item) => {
            if(requiresRoles.hasOwnProperty(item.id)){
                check = true
            }
        });
        return check
    }


    axios.interceptors.response.use(null, (error) =>{
        if(error.response.status === 401){
            store.commit('logout');
            router.push('/login');
        }
        if (error.response.status === 403){
            router.push('/');
        }

        return Promise.reject(error);
    });
}

export function setAuthorization(token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`
}