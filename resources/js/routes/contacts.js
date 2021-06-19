import contacts from '@/pages/contacts/index';
import create from '@/pages/contacts/create';
import update from '@/pages/contacts/update';
import show from '@/pages/contacts/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/contacts`,
        name: `contacts`,
        component: contacts,
    },
    {
        path: `${baseDash}/contacts/create`,
        name: `contactsCreate`,
        component: create,
    },
    {
        path: `${baseDash}/contacts/update/:id`,
        name: `contactsUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/contacts/:id`,
        name: `contactsShow`,
        component: show,
    }
];
