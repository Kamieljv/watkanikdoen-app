import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';
import laravel from 'laravel-vite-plugin';
import Components from 'unplugin-vue-components/vite';
import { PrimeVueResolver } from '@primevue/auto-import-resolver';
import svgLoader from 'vite-svg-loader'
import tailwindcss from 'tailwindcss'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // public assets
                'resources/js/app.js',
                'resources/sass/app.scss',
                // admin assets
                'resources/views/assets/js/app.js',
                'resources/views/assets/sass/app.scss',
                'resources/css/filament/admin/theme.css',
            ],
            refresh: true,
        }),
        vue(),
        svgLoader(),
        Components({
            globs: ['resources/views/assets/js/components/**/*.vue'],
            resolvers: [
                PrimeVueResolver()
            ],

        })
    ],
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js'),
            '&': resolve(__dirname, 'resources/svg'),
            '~fonts': resolve(__dirname, 'public/fonts'),
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});