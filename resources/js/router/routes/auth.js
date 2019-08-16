import RightEnum from '../rights'

import home from '../../components/home'
import pricelist from '../../components/pricelist/read'
import index from '../../components/auth/index'
import login from '../../components/auth/login'
import logout from '../../components/auth/logout'
import forgot from '../../components/auth/forgot'

export default [
    {
        name: 'home',
        path: '/',
        component: home,
        meta: {
            requiresAuth: true,
        },
    },
    {
        name: 'pricelist',
        path: '/pricelist',
        component: pricelist,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/auth',
        component: index,
        children: [
            {
                name: 'authLogin',
                path: 'login',
                component: login
            },
            {
                name: 'authLogout',
                path: 'logout',
                component: logout
            },
            {
                name: 'authForgot',
                path: 'forgot',
                component: forgot
            }
        ]
    },
];
