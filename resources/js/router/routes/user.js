import RightEnum from '../rights'
export default [
    {
        path: '/user',
        component: () => import('../../components/user/index'),
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'userList',
                path: '',
                component: () => import('../../components/user/list'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'userCreate',
                path: 'create',
                component: () => import('../../components/user/create'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'userRead',
                path: ':id',
                component: () => import('../../components/user/read'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            }
        ]
    }
];