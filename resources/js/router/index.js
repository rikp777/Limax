import Vue from "vue";
import VueRouter from 'vue-router';
import palletLabel from "./routes/palletLabel";
import documentation from "./routes/documentation";
import auth from "./routes/auth"
import settings from "./routes/settings"

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: "/",
            component: () => import("../views/Index"),
            children: [
                {
                    path: "farmer",
                    component: () => import("../views/farmer/Index"),
                    children: [
                        ...palletLabel,
                        ...documentation,
                        ...settings
                    ]
                },
                {
                    path: "admin",
                    component: () => import("../views/admin/Index"),
                    children: [
                    ]
                },
                {
                    path: "planning",
                    component: () => import("../views/planning/Index"),
                    children: [
                    ]
                }
            ]
        },
        ...auth
    ],
    linkActiveClass: "active",
    mode: 'history'
});

export default router
