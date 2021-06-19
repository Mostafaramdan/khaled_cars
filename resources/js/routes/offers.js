import offers from '@/pages/offers/index';
import create from '@/pages/offers/create';
import update from '@/pages/offers/update';
import show from '@/pages/offers/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/offers`,
        name: `offers`,
        component: offers,
    },
    {
        path: `${baseDash}/offers/create`,
        name: `offersCreate`,
        component: create,
    },
    {
        path: `${baseDash}/offers/update/:id`,
        name: `offersUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/offers/:id`,
        name: `offersShow`,
        component: show,
    }
];
