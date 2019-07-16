import Home from "./components/Home";
import Login from "./components/Auth/Login";
import UserIndex from "./components/users/Index.vue";
import UserList from "./components/users/List.vue";
import UserCreate from "./components/users/Create.vue";
import UserRead from "./components/users/Read.vue"

export const RightEnum = Object.freeze({"Admin":1, "Moderator":2, "Farmer":3});
export const routes = [
    {
        path: '/',
        component : Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/users',
        component: UserIndex,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                path: '/',
                component: UserList,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                path: 'create',
                component: UserCreate
            },
            {
                path: ':id',
                component: UserRead
            }
        ]
    }
];