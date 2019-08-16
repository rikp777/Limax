import RightEnum from '../rights'


import index from '../../components/palletLabel/index'
import combine from '../../components/palletLabel/combine'
import list from '../../components/palletLabel/list'
import createUpdate from '../../components/palletLabel/create-update'
import read from '../../components/palletLabel/read'
import pdf from '../../components/palletLabel/pdf'

export default [
    {
        path: '/palletLabel',
        component: index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'palletLabelCombine',
                path: 'combine',
                component: combine,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelList',
                path: '',
                component: list,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelCreate',
                path: 'create',
                component: createUpdate,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelUpdate',
                path: 'update/:id',
                component: createUpdate,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelRead',
                path: ':id',
                props: true,
                component: read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelPdf',
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
