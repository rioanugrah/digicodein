import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                // 'resources/sass/app.scss',
                // 'resources/js/app.js',
                // 'resources/css/app.css',
                // 'assets/scss/app.scss'
                // 'resources/assets/scss/app.scss'
            ],
            refresh: true,
        }),
    ],
});
