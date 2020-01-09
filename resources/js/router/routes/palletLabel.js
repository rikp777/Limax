import RightEnum from '../rights'


import Index from '../../components/palletlabel/Index'
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
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
        },
        children: [
            {
                name: 'palletLabelCombine',
                path: 'combine',
                component: Combine,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'palletLabelList',
                path: '',
                component: List,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'palletLabelCreate',
                path: 'create',
                component: CreateUpdate,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'palletLabelUpdate',
                path: 'update/:id',
                component: CreateUpdate,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'palletLabelRead',
                path: ':id',
                props: true,
                component: Read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'palletLabelPdf',
                path: 'pdf/:id',
                props: true,
                component: Pdf,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            }
        ]
    }
];
