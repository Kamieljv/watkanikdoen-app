import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';
import laravel from 'laravel-vite-plugin';
import Components from 'unplugin-vue-components/vite';
import { PrimeVueResolver } from '@primevue/auto-import-resolver';
import svgLoader from 'vite-svg-loader'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/views/assets/js/app.js',
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
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});