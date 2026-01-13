import './bootstrap';
import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Toaster } from '@/components/ui/sonner';

createInertiaApp({
    title: (title) => {
        // Get site name from shared props if available
        const siteName = window.__INERTIA_SSR_DATA__?.props?.site?.name || 
                        document.querySelector('meta[name="site-name"]')?.content || 
                        'Chapakhana';
        return title ? `${title} - ${siteName}` : siteName;
    },
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.jsx`,
            import.meta.glob('./Pages/**/*.jsx')
        ),
    setup({ el, App, props }) {
        const root = createRoot(el);
        root.render(
            <>
                <App {...props} />
                <Toaster position="top-right" richColors />
            </>
        );
    },
    progress: {
        color: '#4B5563',
    },
});
