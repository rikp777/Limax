import Index from '../../views/app/docs/index'
import Welcome from '../../views/app/docs/welcome'
import RightEnum from "../rights";

export default [
    {
        name: 'docs',
        path: 'app/docs',
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
