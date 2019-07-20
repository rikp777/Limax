import RightEnum from '../rights'
export default [
    {
        path: '/palletLabel',
        component: () => import('../../components/palletLabel/index'),
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'palletLabelList',
                path: '',
                component: () => import('../../components/palletLabel/list'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelCreate',
                path: 'create',
                component: () => import('../../components/palletLabel/create'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelRead',
                path: ':id',
                props: true,
                component: () => import('../../components/palletLabel/read'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            }
        ]
    }
];