import RightEnum from '../rights'

import Index from '../../views/planning/Index'
import Create from '../../views/planning/Create'
import Read from '../../views/planning/Read'

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
            }
            // ,
            // {
            //     name: 'planningCreate',
            //     path: 'create',
            //     component: Update,
            //     meta: {
            //         requiresAuth: true,
            //         requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Planning]
            //     },
            // },
        ]
    }
];
