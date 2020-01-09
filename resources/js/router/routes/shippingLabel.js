import RightEnum from '../rights'

import Index from '../../components/shippinglabel/Index'
import Combine from '../../components/shippinglabel/Combine'
import List from '../../components/shippinglabel/List'
import Create from '../../components/shippinglabel/Create'
import Update from '../../components/shippinglabel/Update'
import Read from '../../components/shippinglabel/Read'
import Pdf from '../../components/shippinglabel/Pdf'

export default [
    {
        path: '/shippingLabel',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
        },
        children: [
            {
                name: 'shippingLabelCombine',
                path: 'combine',
                component: Combine,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'shippingLabelList',
                path: '',
                component: List,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'shippingLabelCreate',
                path: 'create',
                component: Create,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'shippingLabelUpdate',
                path: 'update/:id',
                component: Update,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'shippingLabelRead',
                path: ':id',
                props: true,
                component: Read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'shippingLabelPdf',
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
