import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        cors: {
            origin: 'http://localhost.tables',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/css/theme.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
