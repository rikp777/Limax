import RightEnum from '../rights'

import Index from '../../components/report/Index'
import Read from '../../components/report/Read'

export default [
    {
        path: '/report',
        component: Index,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                name: 'reportRead',
                path: '/',
                props: true,
                component: Read,
                meta: {
                    requiresAuth: true,
                },
            }
        ]
    }
];
