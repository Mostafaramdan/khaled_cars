import notifications from '@/pages/notifications/index';
import create from '@/pages/notifications/create';
import update from '@/pages/notifications/update';
import show from '@/pages/notifications/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/notifications`,
        name: `notifications`,
        component: notifications,
    },
    {
        path: `${baseDash}/notifications/create`,
        name: `notificationsCreate`,
        component: create,
    },
    {
        path: `${baseDash}/notifications/update/:id`,
        name: `notificationsUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/notifications/:id`,
        name: `notificationsShow`,
        component: show,
    }
];
