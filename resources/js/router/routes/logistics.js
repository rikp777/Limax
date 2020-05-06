import RightEnum from '../rights'

import Index from '../../views/logistics/overzicht/Index'
import Dashboard from '../../views/logistics/overzicht/Dashboard'

export default [
    {
        path: 'overzicht',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Logistics]
        },
        children: [
            {
                name: 'dashboard',
                path: 'dashboard',
                component: Dashboard,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Logistics]
                },
            }
        ]
    }
];
