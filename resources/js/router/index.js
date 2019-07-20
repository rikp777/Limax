import Vue from "vue";
import VueRouter from 'vue-router';


import auth from '../router/routes/auth'
import user from '../router/routes/user'
import palletLabel from '../router/routes/palletLabel'

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        ...auth,
        ...user,
        ...palletLabel
    ],
    mode: 'history'
});


export default router