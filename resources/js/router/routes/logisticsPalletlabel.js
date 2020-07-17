import RightEnum from '../rights'

import Index from '../../views/logistics/palletlabel/Index'

export default [
    {
        path: 'palletlabel',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Logistics]
        }
    }
];
