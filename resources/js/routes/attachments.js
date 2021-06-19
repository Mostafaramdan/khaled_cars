import housing_units from '@/pages/housing_units/index';
import create from '@/pages/housing_units/create';
import update from '@/pages/housing_units/update';
import show from '@/pages/housing_units/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/housing_units`,
        name: `housing_units`,
        component: housing_units,
    },
    {
        path: `${baseDash}/housing_units/create`,
        name: `housing_unitsCreate`,
        component: create,
    },
    {
        path: `${baseDash}/housing_units/update/:id`,
        name: `housing_unitsUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/housing_units/:id`,
        name: `housing_unitsShow`,
        component: show,
    }
];
