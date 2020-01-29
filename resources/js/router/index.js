import Vue from "vue";
import VueRouter from 'vue-router';
import palletLabel from "./routes/palletLabel";
import documentation from "./routes/documentation";
import auth from "./routes/auth"

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: "/",
            component: () => import("../views/app"),
            redirect: "app/docs",
            children: [
                ...palletLabel,
                ...documentation
            ]
        },
        ...auth
    ],
    linkActiveClass: "active",
    mode: 'history'
});

export default router
