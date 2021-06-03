import login from '@/pages/authentication/login';
import users from '@/routes/users';
import housing_units from '@/routes/housing_units';
import attachments from '@/routes/attachments';
import vouchers from '@/routes/vouchers';
import offers from '@/routes/offers';
import currencies from '@/routes/currencies';
import app_settings from '@/routes/app_settings';
import admins from '@/routes/admins';
import regions from '@/routes/regions';
import orders from '@/routes/orders';
import contacts from '@/routes/contacts';
import notifications from '@/routes/notifications';
import statistics from '@/routes/statistics';
import estates from '@/routes/estates';
const baseDash= '/dashboard';

const routes=
[

    ...users,
    ...housing_units,
    ...attachments,
    ...vouchers,
    ...offers,
    ...currencies,
    ...app_settings,
    ...admins,
    ...regions,
    ...orders,
    ...contacts,
    ...notifications,
    ...statistics,
    ...estates,
    {
        path: `${baseDash}/login`,
        name: 'login',
        component: login,
    },
    {
        path: '*',
        redirect: { name: 'statistics' }
    }


];
export default routes;
