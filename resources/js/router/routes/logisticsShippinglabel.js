import RightEnum from '../rights'

import Index from '../../views/logistics/shippinglabel/Index'

export default [
    {
        path: 'shippinglabel',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Logistics]
        }
    }
];
