import RightEnum from '../rights'

import Index from '../../components/planning/Index'
import Read from '../../components/planning/Read'
import Update from "../../components/planning/update";

export default [
    {
        path: '/planning',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Planning]
        },
        children: [
            {
                name: 'planningRead',
                path: 'overview',
                component: Read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Planning]
                },
            },
            {
                name: 'planningCreate',
                path: 'create',
                component: Update,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Planning]
                },
            },
        ]
    }
];
