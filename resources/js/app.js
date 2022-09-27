import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import Echo from 'laravel-echo';
import Pusher from "pusher-js";

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({methods: { route }})
            .mount(el)
    },
})

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'tic-tac-toe',
    forceTLS: false,
    wsHost: 'localhost',
    wsPort: 6001,
    encrypted: false
});

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
