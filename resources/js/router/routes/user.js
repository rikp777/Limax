import RightEnum from '../rights'

import Index from '../../views/admin/users/Index'
import Create from '../../views/admin/users/Create'

export default [
    {
        path: 'user',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'create',
                path: 'create',
                component: Create,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            }
        ]
    }
];
