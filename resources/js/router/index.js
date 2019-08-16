import Vue from "vue";
import VueRouter from 'vue-router';



import auth from '../router/routes/auth'
import user from '../router/routes/user'
import palletLabel from '../router/routes/palletLabel'
import shippingLabel from '../router/routes/shippingLabel'
import article from '../router/routes/article'
import pricelist from "./routes/pricelist";

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        ...article,
        ...auth,
        ...user,
        ...palletLabel,
        ...shippingLabel,
        ...pricelist
    ],
    mode: 'history'
});

export default router
