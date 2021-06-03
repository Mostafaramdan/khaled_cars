import countries from '@/pages/regions/countries';
import cities from '@/pages/regions/cities';
import districts from '@/pages/regions/districts';
import create from '@/pages/regions/create';
import update from '@/pages/regions/update';
import show from '@/pages/regions/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/countries`,
        name: `countries`,
        component: countries,
    },
    {
        path: `${baseDash}/cities`,
        name: `cities`,
        component: cities,
    },
    {
        path: `${baseDash}/districts`,
        name: `districts`,
        component: districts,
    },
    {
        path: `${baseDash}/regions/create`,
        name: `regionsCreate`,
        component: create,
    },
    {
        path: `${baseDash}/regions/update/:id`,
        name: `regionsUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/regions/:id`,
        name: `regionsShow`,
        component: show,
    }
];
