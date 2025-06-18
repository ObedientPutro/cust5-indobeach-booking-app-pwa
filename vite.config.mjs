import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { VitePWA } from "vite-plugin-pwa";

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        VitePWA({
            registerType: 'autoUpdate',
            injectRegister: false,
            srcDir: 'public',
            filename: 'sw.js',
            strategies: 'injectManifest',
            workbox: {
                cleanupOutdatedCaches: true,
            },
            manifest: {
                name: 'Indo Beach Resort',
                short_name: 'IndoBeach',
                description: 'Sistem Informasi Reservasi Cottage Pada Wisata Pantai Indo Beach & Resort.',
                theme_color: '#ffffff',
                background_color: '#ffffff',
                display: 'standalone',
                scope: '/',
                start_url: '/',
                icons: [
                    {
                        src: '/images/icons/icon-192x192.png',
                        sizes: '192x192',
                        type: 'image/png',
                    },
                    {
                        src: '/images/icons/icon-512x512.png',
                        sizes: '512x512',
                        type: 'image/png',
                    },
                ],
            },
        }),
    ],
    server: {
        host: 'localhost',
        port: 5173,
    },
});
