import Index from '../../views/farmer/docs/index'
import Welcome from '../../views/farmer/docs/welcome'
import RightEnum from "../rights";

export default [
    {
        name: 'docs',
        path: 'farmer/docs',
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
