import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: false,
    disableStats: true,
});

window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('✅ WEBSOCKET CONNECTED')
})

window.Echo.connector.pusher.connection.bind('error', (err) => {
    console.error('❌ WS ERROR', err)
})
