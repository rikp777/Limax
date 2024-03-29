import RightEnum from '../rights'

import Index from '../../views/farmer/settings/Index'
import Overview from '../../views/farmer/settings/Overview'

export default [
    {
        path: 'settings',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
        },
        children: [
            {
                name: 'settingOverview',
                path: '/',
                component: Overview,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            }
        ]
    }
];
