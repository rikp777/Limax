import RightEnum from '../rights'

import index from '../../components/shippingLabel/index'
import combine from '../../components/shippingLabel/combine'
import list from '../../components/shippingLabel/list'
import create from '../../components/shippingLabel/create'
import update from '../../components/shippingLabel/update'
import read from '../../components/shippingLabel/read'
import pdf from '../../components/shippingLabel/pdf'

export default [
    {
        path: '/shippingLabel',
        component: index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'shippingLabelCombine',
                path: 'combine',
                component: combine,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelList',
                path: '',
                component: list,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelCreate',
                path: 'create',
                component: create,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelUpdate',
                path: 'update/:id',
                component: update,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelRead',
                path: ':id',
                props: true,
                component: read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelPdf',
                path: 'pdf/:id',
                props: true,
                component: pdf,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            }
        ]
    }
];
