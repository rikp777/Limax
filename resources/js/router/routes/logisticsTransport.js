import RightEnum from '../rights'

import Index from '../../views/logistics/transport/Index'

export default [
    {
        path: 'transport',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Logistics]
        }
    }
];
