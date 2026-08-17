import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import Lenis from 'lenis';

// Initialize Lenis smooth scrolling
const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smoothWheel: true,
});

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}
requestAnimationFrame(raf);

createInertiaApp({
    title: (title) => title ? `${title} - Senzu Transport` : 'Senzu Transport',
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);

        // Dismiss the page loader after mount
        const loader = document.getElementById('page-loader');
        if (loader) {
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                loader.classList.add('loaded');
                setTimeout(() => {
                    document.body.style.overflow = '';
                    loader.remove();
                }, 560);
            }, 950);
        }

        return app;
    },
    progress: {
        color: '#7CFC00',
    },
});
