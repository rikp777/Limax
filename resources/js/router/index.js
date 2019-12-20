import Vue from "vue";
import VueRouter from 'vue-router';



import auth from '../router/routes/auth'
import user from '../router/routes/user'
import palletLabel from '../router/routes/palletLabel'
import shippingLabel from '../router/routes/shippingLabel'
import article from '../router/routes/article'
import priceList from "./routes/pricelist";
import profile from "./routes/profile";
import settings from "./routes/settings";
import truck from "../router/routes/truck";

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        ...truck,
        ...article,
        ...auth,
        ...user,
        ...palletLabel,
        ...shippingLabel,
        ...priceList,
        ...profile,
        ...settings
    ],
    mode: 'history'
});

export default router
