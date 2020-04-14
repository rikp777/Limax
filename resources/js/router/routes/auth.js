import RightEnum from '../rights'

import Home from '../../components/Home'
import Pricelist from '../../components/pricelist/Read'
import Index from '../../views/auth/index'
import Login from '../../views/auth/Login'
import Logout from '../../views/auth/Logout'
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
                name: 'login',
                path: 'login',
                component: Login
            },
            {
                name: 'logout',
                path: 'logout',
                component: Logout
            },
            {
                name: 'forgot',
                path: 'forgot',
                component: Forgot
            }
        ]
    },
];
