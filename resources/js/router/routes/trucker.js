import RightEnum from '../rights'

import Index from '../../views/trucker/transport/Index'
import truckerShippinglabel from '../../views/trucker/transport/Dashboard'

export default [
    {
        path: 'transport',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Trucker]
        },
        children: [
            {
                name: 'shippinglabel',
                path: 'shippinglabel',
                component: truckerShippinglabel,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Trucker]
                },
            }
        ]
    }
];
