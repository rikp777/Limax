import RightEnum from '../rights'

import Index from '../../views/admin/reports/Index'
import Create from '../../views/admin/reports/Create'
import Read from '../../views/admin/reports/Read'

export default [
    {
        path: 'report',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
        },
        children: [
            {
                name: 'overview',
                path: 'overview',
                props: true,
                component: Read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            }
        ]
    }
];
