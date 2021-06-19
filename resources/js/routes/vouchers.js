import vouchers from '@/pages/vouchers/index';
import create from '@/pages/vouchers/create';
import update from '@/pages/vouchers/update';
import show from '@/pages/vouchers/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/vouchers`,
        name: `vouchers`,
        component: vouchers,
    },
    {
        path: `${baseDash}/vouchers/create`,
        name: `vouchersCreate`,
        component: create,
    },
    {
        path: `${baseDash}/vouchers/update/:id`,
        name: `vouchersUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/vouchers/:id`,
        name: `vouchersShow`,
        component: show,
    }
];
