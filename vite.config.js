import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/login.js',
                'resources/js/admin.js',
                'resources/css/featured-product.css',
                'resources/js/featured-product.js',
                'resources/css/commerce.css',
                'resources/css/login.css',
                'resources/css/profile.css',
                'resources/css/Riwayat-Pesanan.css',
                'resources/css/detail.css',
                'resources/css/pembayaran.css',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
