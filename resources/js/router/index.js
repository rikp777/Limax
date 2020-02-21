import Vue from "vue";
import VueRouter from 'vue-router';
import palletLabel from "./routes/palletLabel";
import documentation from "./routes/documentation";
import auth from "./routes/auth"
import settings from "./routes/settings"
import article from "./routes/article"
import user from "./routes/user"
import report from "./routes/report"
import planning from "./routes/planning"
import shippingLabel from "./routes/shippingLabel";
import weight from "./routes/weight";

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
                        ...shippingLabel,
                        ...report,
                        ...documentation,
                        ...settings
                    ]
                },
                {
                    path: "admin",
                    component: () => import("../views/admin/Index"),
                    children: [
                        ...user,
                        ...article,
                        ...report,
                        ...palletLabel,
                        ...shippingLabel,
                        ...settings,
                        ...planning

                    ]
                },
                {
                    path: "planner",
                    component: () => import("../views/planning/Index"),
                    children: [
                        ...planning
                    ]
                },
                {
                    path: "production",
                    component: () => import('../views/production/Index'),
                    children: [
                        ...weight
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
