import orders from '@/pages/orders/index';
import create from '@/pages/orders/create';
import update from '@/pages/orders/update';
import show from '@/pages/orders/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/orders`,
        name: `orders`,
        component: orders,
    },
    {
        path: `${baseDash}/orders/create`,
        name: `ordersCreate`,
        component: create,
    },
    {
        path: `${baseDash}/orders/update/:id`,
        name: `ordersUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/orders/:id`,
        name: `ordersShow`,
        component: show,
    }
];
