import app_settings from '@/pages/app_settings/index';
import create from '@/pages/app_settings/create';
import update from '@/pages/app_settings/update';
import show from '@/pages/app_settings/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/app_settings`,
        name: `app_settings`,
        component: app_settings,
    },
    {
        path: `${baseDash}/app_settings/create`,
        name: `app_settingsCreate`,
        component: create,
    },
    {
        path: `${baseDash}/app_settings/update/:id`,
        name: `app_settingsUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/app_settings/:id`,
        name: `app_settingsShow`,
        component: show,
    }
];
