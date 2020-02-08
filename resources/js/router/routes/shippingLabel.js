import RightEnum from '../rights'

import Index from '../../views/farmer/shippinglabel/Index'
import Pdf from '../../views/farmer/shippinglabel/Pdf.View'
import Create from '../../views/farmer/shippinglabel/Create.View'

export default [
    {
        path: 'shippinglabel',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
        },
        children: [
            {
                name: 'shippinglabelCreate',
                path: 'create',
                component: Create,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'shippinglabelPdf',
                path: 'pdf/:id',
                component: Pdf,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
        ]
    }
];
