import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    },
});

const myRandomId = document
    .querySelector('meta[name="random-id"]')
    .getAttribute('content');

console.log('My random ID:', myRandomId);

window.Echo.join('shared')
    .here((clients) => {
        console.log('Currently connected:', clients); // (•‿•)
    })
    .joining((client) => {
        console.log('Client joined:', client); // (ツ)
    })
    .leaving((client) => {
        console.log('Client left:', client); // (≧◡≦)
    });

window.Echo.private(`client.${myRandomId}`)
    .listen('.DirectMessage', (payload) => {
        console.log('Direct message received:', payload);
    });

//
//
// window.Echo.channel('delivery')
//     .listen('.PackageSent', (event) => {
//         console.log(event);     // (•‿•)
//         console.log(event.hello); // (ツ)
//     });
//
// window.testpush = () => {
//     window.Echo.channel('delivery').pusher.send_event('PackageSent', {'hello': 'awd'}, 'delivery');
// }
