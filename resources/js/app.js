// resources/js/app.js

import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import vuetify from './Plugins/vuetify'; // Vuetify setup

// App name from .env
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Create Inertia app
createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    // Lazy-load pages automatically
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),

    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)       // Inertia plugin
            .use(ZiggyVue)     // Ziggy routes
            .use(vuetify)      // Vuetify
            .mount(el);
    },

    // Inertia progress bar for better UX
    progress: {
        color: '#4B5563',
        showSpinner: true,
    },
});
