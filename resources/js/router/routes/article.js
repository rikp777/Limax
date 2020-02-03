import Index from '../../views/admin/articles/Index'
import Create from '../../views/admin/articles/Create'


export default [
    {
        path: 'article',
        component: Index,
        children: [
            {
                name: 'create',
                path: 'create',
                component: Create
            }
        ]
    },
];
