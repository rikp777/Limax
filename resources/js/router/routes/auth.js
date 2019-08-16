import RightEnum from '../rights'

import Home from '../../components/Home'
import Pricelist from '../../components/pricelist/Read'
import Index from '../../components/auth/Index'
import Login from '../../components/auth/Login'
import Logout from '../../components/auth/Logout'
import Forgot from '../../components/auth/Forgot'

export default [
    {
        name: 'home',
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/auth',
        component: Index,
        children: [
            {
                name: 'authLogin',
                path: 'login',
                component: Login
            },
            {
                name: 'authLogout',
                path: 'logout',
                component: Logout
            },
            {
                name: 'authForgot',
                path: 'forgot',
                component: Forgot
            }
        ]
    },
];
