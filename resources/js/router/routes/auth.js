import RightEnum from '../rights'
export default [
    {
        name: 'home',
        path: '/',
        component: () => import('../../components/home'),
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/auth',
        component: () => import('../../components/auth/index'),
        children: [
            {
                name: 'authLogin',
                path: 'login',
                component: () => import('../../components/auth/login')
            },
            {
                name: 'authLogout',
                path: 'logout',
                component: () => import('../../components/auth/logout')
            },
            {
                name: 'authForgot',
                path: 'forgot',
                component: () => import('../../components/auth/forgot')
            }
        ]
    },
];
