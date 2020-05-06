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
import RightEnum from "./rights";

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: "/",
            component: () => import("../views/Index"),
            meta: {
                requiresAuth: true
            },
            children: [
                {
                    path: "farmer",
                    component: () => import("../views/farmer/Index"),
                    meta: {
                        requiresAuth: true,
                        requiresRoles: [ RightEnum.Admin, RightEnum.Farmer]
                    },
                    children: [
                        ...palletLabel ,
                        ...shippingLabel,
                        ...report,
                        ...documentation,
                        ...settings
                    ]
                },
                {
                    path: "admin",
                    component: () => import("../views/admin/Index"),
                    meta: {
                        requiresAuth: true,
                        requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                    },
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
                    meta: {
                        requiresAuth: true,
                        requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Planning]
                    },
                    children: [
                        ...planning
                    ]
                },
                {
                    path: "production",
                    component: () => import('../views/production/Index'),
                    meta: {
                        requiresAuth: true,
                        requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Production]
                    },
                    children: [
                        ...weight
                    ]
                }
                // {
                //     path: "logistics",
                //     component: () => import('../views/logistics/Index'),
                //     meta: {
                //         requiresAuth: true,
                //         requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Logistics]
                //     },
                // }
            ]
        },
        ...auth
    ],
    linkActiveClass: "active",
    mode: 'history'
});

export default router
