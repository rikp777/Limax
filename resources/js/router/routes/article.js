import index from '../../components/article/views/index'
import list from '../../components/article/views/list'
import read from '../../components/article/views/read'


export default [
    {
        path: '/article',
        component: index,
        children: [
            {
                name: 'list',
                path: '',
                component: list
            },
            {
                name: 'read',
                path: 'read/:id',
                component: read
            },
        ]
    },
];
