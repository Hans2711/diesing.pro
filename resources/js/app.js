import "./bootstrap";
import "../css/app.css";

import.meta.glob([
    "../logo/**",
    "../portfolio/**",
    "../images/**",
    "../icons/**",
]);

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST ?? window.location.hostname,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'http') === 'https',
    enabledTransports: ['ws', 'wss'],
});

// WebSocket connection success
window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('WebSocket connected successfully!');
});

// WebSocket connection error handling
window.Echo.connector.pusher.connection.bind('error', (err) => {
    console.error('WebSocket connection error:', err);
});

// Optional: Connection disconnected
window.Echo.connector.pusher.connection.bind('disconnected', () => {
    console.warn('WebSocket disconnected.');
});

// Generate a random unique ID per session
const sessionId = sessionStorage.getItem('userId') || (() => {
    const id = 'user-' + Math.random().toString(36).substr(2, 9);
    sessionStorage.setItem('userId', id);
    return id;
})();

console.log('User ID:', sessionId);

axios.post('/session-login', { sessionId })
    .then(response => {
        console.log('Logged in as:', response.data.user);
        // Join public channel
        window.Echo.channel('public-online-users')
            .listen('.UserPresenceEvent', (e) => {
                if (e.type === 'join') {
                    console.log(`٩(｡•́‿•̀｡)۶ "${e.userId}" joined!`);
                } else if (e.type === 'leave') {
                    console.log(`(｡•́︿•̀｡) "${e.userId}" left!`);
                }
            })
        ;

        window.Echo.private(`user.${sessionId}`)
            .listen('.DataReceivedEvent', (e) => {
                const receivedData = atob(e.data);
                console.log(`(✿◠‿◠) Received private data from "${e.senderId}":`, receivedData);
            });
    });

// Notify backend you're here (join)
axios.post('/api/presence/join', { userId: sessionId })
    .then(response => {
        const activeUsers = response.data.active_users;
        console.log('(•‿•) Active users right now:', activeUsers);
    })
    .catch(err => {
        console.error('(╥﹏╥) Error joining presence:', err);
    });

setInterval(() => {
    axios.post('/api/presence/join', { userId: sessionId })
        .catch(err => console.error('Heartbeat error:', err));
}, 300000); // 300000ms = 5 minutes

window.addEventListener('beforeunload', () => {
    const data = new FormData();
    data.append('userId', sessionId);

    navigator.sendBeacon('/api/presence/leave', data);
});

window.sendData = (data, userId) => {
    const formData = new FormData();
    formData.append('userId', userId);
    formData.append('senderId', sessionId);

    // Handle binary (Blob, File, ArrayBuffer) or string data explicitly
    if (data instanceof Blob || data instanceof ArrayBuffer) {
        const blobData = data instanceof Blob ? data : new Blob([data]);
        formData.append('data', blobData, 'upload.bin');
    } else {
        formData.append('data', data);
    }

    return axios.post('/api/send-data', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
    }).then(response => {
            console.log('(•‿•) Data sent successfully:', response.data);
        }).catch(err => {
            console.error('(╥﹏╥) Error sending data:', err.response?.data || err);
        });
};
