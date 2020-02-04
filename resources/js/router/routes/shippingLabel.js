import RightEnum from '../rights'

import Index from '../../views/farmer/shippinglabel/Index'
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
        ]
    }
];
