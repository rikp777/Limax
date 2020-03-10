import Index from '../../views/farmer/docs/index'
import Welcome from '../../views/farmer/docs/Welcome'
import RightEnum from "../rights";

export default [
    {
        name: 'docs',
        path: 'docs',
        component: Index,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                name: 'welcome',
                path: '',
                component: Welcome,
                meta: {
                    requiresAuth: true
                },
            },
        ]
    },
]
