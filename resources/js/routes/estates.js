import estates from '@/pages/estates/index';
import create from '@/pages/estates/create';
import update from '@/pages/estates/update';
import show from '@/pages/estates/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/estates`,
        name: `estates`,
        component: estates,
    },
    {
        path: `${baseDash}/estates/create`,
        name: `estatesCreate`,
        component: create,
    },
    {
        path: `${baseDash}/estates/update/:id`,
        name: `estatesUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/estates/:id`,
        name: `estatesShow`,
        component: show,
    }
];
