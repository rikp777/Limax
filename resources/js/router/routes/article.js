export default [
    {
        path: '/article',
        component: () => import('../../components/article/views/index'),
        children: [
            {
                name: 'list',
                path: '',
                component: () => import('../../components/article/views/list')
            },
            {
                name: 'read',
                path: 'read/:id',
                component: () => import('../../components/article/views/read')
            },
        ]
    },
];
