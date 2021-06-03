import attachments from '@/pages/attachments/index';
import create from '@/pages/attachments/create';
import update from '@/pages/attachments/update';
import show from '@/pages/attachments/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/attachments`,
        name: `attachments`,
        component: attachments,
    },
    {
        path: `${baseDash}/attachments/create`,
        name: `attachmentsCreate`,
        component: create,
    },
    {
        path: `${baseDash}/attachments/update/:id`,
        name: `attachmentsUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/attachments/:id`,
        name: `attachmentsShow`,
        component: show,
    }
];
