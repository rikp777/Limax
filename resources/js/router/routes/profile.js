import RightEnum from '../rights'

import Index from '../../components/profile/Index'
import Read from '../../components/profile/Read'

export default [
    {
        path: '/profile',
        component: Index,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                name: 'profileRead',
                path: '/',
                component: Read,
                meta: {
                    requiresAuth: true,
                },
            }
        ]
    }
];
