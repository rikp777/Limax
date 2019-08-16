import Index from '../../components/article/views/Index'
import List from '../../components/article/views/List'
import Read from '../../components/article/views/Read'


export default [
    {
        path: '/article',
        component: Index,
        children: [
            {
                name: 'list',
                path: '',
                component: List
            },
            {
                name: 'read',
                path: 'read/:id',
                component: Read
            },
        ]
    },
];
