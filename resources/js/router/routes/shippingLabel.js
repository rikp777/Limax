import RightEnum from '../rights'
export default [
    {
        path: '/shippingLabel',
        component: () => import('../../components/shippingLabel/index'),
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'shippingLabelCombine',
                path: 'combine',
                component: () => import('../../components/shippingLabel/combine'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelList',
                path: '',
                component: () => import('../../components/shippingLabel/list'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelCreate',
                path: 'create',
                component: () => import('../../components/shippingLabel/create'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelUpdate',
                path: 'update/:id',
                component: () => import('../../components/shippingLabel/update'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelRead',
                path: ':id',
                props: true,
                component: () => import('../../components/shippingLabel/read'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelPdf',
                path: 'pdf/:id',
                props: true,
                component: () => import('../../components/shippingLabel/pdf'),
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            }
        ]
    }
];