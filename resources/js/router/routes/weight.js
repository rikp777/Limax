import RightEnum from '../rights'

import Index from '../../views/production/weight/Index'
import Dashboard from '../../views/production/weight/Dashboard'

export default [
    {
        path: 'weight',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'dashboard',
                path: 'dashboard',
                component: Dashboard,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            }
        ]
    }
];
