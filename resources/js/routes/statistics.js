import statistics from '@/pages/statistics/index';
import create from '@/pages/statistics/create';
import update from '@/pages/statistics/update';
import show from '@/pages/statistics/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/statistics`,
        name: `statistics`,
        component: statistics,
    },
    {
        path: `${baseDash}/statistics/create`,
        name: `statisticsCreate`,
        component: create,
    },
    {
        path: `${baseDash}/statistics/update/:id`,
        name: `statisticsUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/statistics/:id`,
        name: `statisticsShow`,
        component: show,
    }
];
