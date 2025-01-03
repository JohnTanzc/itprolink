import Echo from 'laravel-echo';
import io from 'socket.io-client';

window.Echo = new Echo({
    broadcaster: 'socket.io',   // Change this from 'pusher' to 'socket.io'
    client: io,                 // Pass socket.io-client here
    host: window.location.hostname + ':6001', // Your WebSocket server URL
    forceTLS: false,
});
