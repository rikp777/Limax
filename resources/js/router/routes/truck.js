import Index from '../../components/truck/views/Index'
import List from '../../components/truck/views/List'
import Read from '../../components/truck/views/Read'


export default [
    {
        path: '/truck',
        component: Index,
        children: [
            {
                name: 'truckList',
                path: '',
                component: List
            },
            {
                name: 'truckRead',
                path: 'truckRead/:id',
                component: Read
            },
        ]
    },
];
