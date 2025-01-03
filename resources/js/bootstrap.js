window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';
import Echo from 'laravel-echo';
import socketioClient from 'socket.io-client';

// Initialize Echo with Socket.IO
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    client: socketioClient
});

// Listen for new messages on the conversation channel
window.Echo.private('conversation.' + conversationId)
    .listen('MessageSent', (event) => {
        console.log('Message received:', event.message);

        // Add the new message to the conversation box
        appendMessageToConversation(event.message);
    });

// Function to add message to the conversation box
function appendMessageToConversation(message) {
    // Add message to the conversation UI
    const messageContainer = document.querySelector('#conversation-box');
    const newMessageElement = document.createElement('div');
    newMessageElement.classList.add('message');
    newMessageElement.innerHTML = `${message.user.name}: ${message.content}`;
    messageContainer.appendChild(newMessageElement);
}


// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
