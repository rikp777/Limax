import RightEnum from '../rights'

import Index from '../../views/trucker/transport/Index'
import truckerShippinglabel from '../../views/trucker/transport/Dashboard'
import truckerShippinglabelPdf from '../../views/trucker/transport/pdf'

export default [
    {
        path: 'transport',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Trucker]
        },
        children: [
            {
                name: 'shippinglabel',
                path: 'shippinglabel',
                component: truckerShippinglabel,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Trucker]
                },
            },
            {
                name: 'shippinglabelpdf',
                path: 'shippinglabelpdf',
                component: truckerShippinglabelPdf,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Trucker]
                },
            }
        ]
    }
];
