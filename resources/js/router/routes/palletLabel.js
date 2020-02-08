import RightEnum from '../rights'


import Index from '../../views/farmer/palletlabel/Index'
import Create from '../../views/farmer/palletlabel/Create.View'
import Pdf from '../../views/farmer/palletlabel/Pdf.View'


export default [
    {
        path: 'palletlabel',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
        },
        children: [
            {
                name: 'palletlabelCreate',
                path: 'create',
                component: Create,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
            {
                name: 'palletlabelPdf',
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
