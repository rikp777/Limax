import RightEnum from '../rights'


import Index from '../../components/palletlabel/index'
import Combine from '../../components/palletlabel/Combine'
import List from '../../components/palletlabel/List'
import CreateUpdate from '../../components/palletlabel/CreateUpdate'
import Read from '../../components/palletlabel/Read'
import Pdf from '../../components/palletlabel/Pdf'

export default [
    {
        path: '/palletLabel',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'palletLabelCombine',
                path: 'combine',
                component: Combine,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelList',
                path: '',
                component: List,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelCreate',
                path: 'create',
                component: CreateUpdate,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelUpdate',
                path: 'update/:id',
                component: CreateUpdate,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelRead',
                path: ':id',
                props: true,
                component: Read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'palletLabelPdf',
                path: 'pdf/:id',
                props: true,
                component: Pdf,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            }
        ]
    }
];
