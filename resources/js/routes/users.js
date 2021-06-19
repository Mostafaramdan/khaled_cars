import users from '@/pages/users/index';
import create from '@/pages/users/create';
import update from '@/pages/users/update';
import show from '@/pages/users/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/users`,
        name: `users`,
        component: users,
    },
    {
        path: `${baseDash}/users/create`,
        name: `usersCreate`,
        component: create,
    },
    {
        path: `${baseDash}/users/update/:id`,
        name: `usersUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/users/:id`,
        name: `usersShow`,
        component: show,
    }
];
