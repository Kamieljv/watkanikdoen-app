import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';
import laravel from 'laravel-vite-plugin';
import Components from 'unplugin-vue-components/vite';
import { PrimeVueResolver } from '@primevue/auto-import-resolver';
import svgLoader from 'vite-svg-loader'
import { visualizer } from 'rollup-plugin-visualizer';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // admin assets
                'resources/views/assets/js/app.js',
                'resources/views/assets/sass/app.scss',
                'resources/css/filament/admin/theme.css',
            ],
            refresh: true,
        }),
        vue({
            template: {
                compilerOptions: {
                    // Remove comments and whitespace in production
                    comments: false
                }
            }
        }),
        svgLoader({
            svgoConfig: {
                multipass: true,
            }
        }),
        Components({
            globs: ['resources/views/assets/js/components/**/*.vue'],
            resolvers: [
                PrimeVueResolver()
            ],
        }),
        // Uncomment to analyze bundle size
        // visualizer({
        //     open: true,
        //     gzipSize: true,
        //     brotliSize: true,
        // })
    ],
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js'),
            '&': resolve(__dirname, 'resources/svg'),
            '~fonts': resolve(__dirname, 'public/fonts'),
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    // Separate PrimeVue components
                    'primevue-core': ['primevue/config'],
                    // Separate large libraries
                    'leaflet': ['leaflet', '@vue-leaflet/vue-leaflet'],
                    'tiptap': [
                        '@tiptap/vue-3',
                        '@tiptap/core',
                        '@tiptap/starter-kit',
                        '@tiptap/extension-character-count',
                        '@tiptap/extension-underline'
                    ],
                    // Vendor chunk for common dependencies
                    'vendor': ['vue', 'axios', 'alpinejs'],
                }
            }
        },
        // Enable minification
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true, // Remove console.log in production
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info'],
            },
        },
        // Adjust chunk size warnings
        chunkSizeWarningLimit: 600,
        // Enable CSS code splitting
        cssCodeSplit: true,
    },
});
