import RightEnum from '../rights'

import Index from '../../views/logistics/planning/Index'

export default [
    {
        path: 'planning',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Logistics]
        }
    }
];
