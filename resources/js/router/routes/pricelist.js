import Index from '../../components/pricelist/Index'
import Create from '../../components/pricelist/Create'
import Pdf from '../../components/pricelist/Pdf'


export default [
    {
        path: '/pricelist',
        component: Index,
        children: [
            {
                name: 'priceListCreate',
                path: 'create',
                component: Create
            },
            {
                name: 'priceListPdf',
                path: 'pdf',
                component: Pdf
            },
        ]
    },
];
