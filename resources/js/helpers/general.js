
export function initialize(store, router) {
    router.beforeEach((to, from, next) => {
        //console.log(to);
        console.log('to=' + to.name + ' path=' + to.path);
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        const requiresRoles = to.meta.requiresRoles;
        const authUser = store.getters['auth/authUser'];

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
                Toast.fire({
                    type: 'error',
                    title: 'unauthorized',
                });
                next('/')
            }
        } else{
            next();
        }
        if (authUser) {
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
            store.commit('auth/logout');
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