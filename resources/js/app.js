import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy'; // auto-generated if you publish Ziggy routes


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),
    
    // VÊ PÊŞKA 'setup' BI TÊMAMÎ BIGUHERÎNE
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) }); // 1. Yek car app tê çêkirin

        app.use(plugin);
        app.use(ZiggyVue);

        // 2. Fonksiyona wergerandinê li ser app a heyî tê zêdekirin
        app.config.globalProperties.__ = (key) => {
            const translations = props.initialPage.props.translations;
            // Piştrast be ku translations û key hene
            return translations && translations[key] ? translations[key] : key;
        };

        app.mount(el); // 3. Yek car mount dibe
    },

    
    progress: {
        color: '#4B5563',
    },

    
});
