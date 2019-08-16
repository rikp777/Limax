import RightEnum from '../rights'

import index from '../../components/user/index'
import list from '../../components/user/list'
import create from '../../components/user/create'
import read from '../../components/user/read'

export default [
    {
        path: '/user',
        component: index,
        meta: {
            requiresAuth: true,
            requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
        },
        children: [
            {
                name: 'userList',
                path: '',
                component: list,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'userCreate',
                path: 'create',
                component: create,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            },
            {
                name: 'userRead',
                path: ':id',
                component: read,
                meta: {
                    requiresAuth: true,
                    requiresRoles: [ RightEnum.Admin, RightEnum.Moderator]
                },
            }
        ]
    }
];
