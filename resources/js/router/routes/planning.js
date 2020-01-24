import RightEnum from '../rights'

import Index from '../../components/planning/Index'
import Read from '../../components/planning/Read'

export default [
    {
        path: '/planning',
        component: Index,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                name: 'planningRead',
                path: '/',
                component: Read,
                meta: {
                    requiresAuth: true,
                },
            }
        ]
    }
];
