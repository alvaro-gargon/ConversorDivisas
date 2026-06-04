import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/main.js', 'resources/css/estilos.css'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        vue(),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        cors: true,
        headers: {
            'Access-Control-Allow-Private-Network': 'true',
        },
        hmr: {
            host: '192.168.1.134',
            port: 5173,
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
