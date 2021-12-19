
import Echo from 'laravel-echo'; 
window.Pusher = require('pusher-js'); 
window.Echo = new Echo({
     broadcaster: 'pusher',
     key: 'PUSHER_APP_KEY',
     cluster: 'mt1',
     forceTLS: false,
     disableStats: true,
     wssHost: 'khaled-cars-ws.magdsoft.com',
     wsPort: 6001,
     wssPort: 443,
});