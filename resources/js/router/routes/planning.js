import RightEnum from '../rights'

import Index from '../../views/admin/planning/Index'
import Create from '../../views/admin/planning/Create'
import Read from '../../views/admin/planning/Read'
import Total from '../../views/admin/planning/Total'

export default [
    {
        path: 'planning',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Planning]
        },
        children: [
            {
                name: 'overview',
                path: 'overview',
                component: Read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Planning]
                },
            },
            {
                name: 'planningView',
                path: 'planningView',
                component: Total,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Planning]
                },
            },
            {
                name: 'planningCreate',
                path: 'create',
                component: Create,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Planning]
                },
            },
        ]
    }
];
