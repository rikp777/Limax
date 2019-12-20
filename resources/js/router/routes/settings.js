import RightEnum from '../rights'

import Index from '../../components/settings/Index'
import Read from '../../components/settings/Read'

export default [
    {
        path: '/settings',
        component: Index,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                name: 'settingsRead',
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
