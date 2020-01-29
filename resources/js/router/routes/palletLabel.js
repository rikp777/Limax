import RightEnum from '../rights'


import Index from '../../views/app/palletlabel/index'
import Create from '../../views/app/palletlabel/create'


export default [
    {
        path: 'app/palletlabel',
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
