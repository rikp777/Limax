import RightEnum from '../rights'


import Index from '../../views/farmer/palletlabel/index'
import Create from '../../views/farmer/palletlabel/create'


export default [
    {
        path: 'farmer/palletlabel',
        component: Index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
        },
        children: [
            {
                name: 'palletlabelCreate',
                path: 'create',
                component: Create,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator, RightEnum.Farmer]
                },
            },
        ]
    }
];
