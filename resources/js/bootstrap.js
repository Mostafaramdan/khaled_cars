import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
   broadcaster: 'pusher',
   key: 'key',
   host: window.location.hostname + ':6001',
   wsHost: window.location.hostname,
   wsPort: 6001,
   cluster: process.env.MIX_PUSHER_APP_CLUSTER,
   forceTLS: true
});
