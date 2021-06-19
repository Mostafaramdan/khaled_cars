import currencies from '@/pages/currencies/index';
import create from '@/pages/currencies/create';
import update from '@/pages/currencies/update';
import show from '@/pages/currencies/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/currencies`,
        name: `currencies`,
        component: currencies,
    },
    {
        path: `${baseDash}/currencies/create`,
        name: `currenciesCreate`,
        component: create,
    },
    {
        path: `${baseDash}/currencies/update/:id`,
        name: `currenciesUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/currencies/:id`,
        name: `currenciesShow`,
        component: show,
    }
];
