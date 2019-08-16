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
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'shippingLabelCombine',
                path: 'combine',
                component: Combine,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelList',
                path: '',
                component: List,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelCreate',
                path: 'create',
                component: Create,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelUpdate',
                path: 'update/:id',
                component: Update,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelRead',
                path: ':id',
                props: true,
                component: Read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'shippingLabelPdf',
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
