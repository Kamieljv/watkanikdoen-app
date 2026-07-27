import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import { resolve } from "path";
import laravel from "laravel-vite-plugin";
import Components from "unplugin-vue-components/vite";
import { PrimeVueResolver } from "@primevue/auto-import-resolver";
import svgLoader from "vite-svg-loader";
import { visualizer } from "rollup-plugin-visualizer";
import vueDevTools from "vite-plugin-vue-devtools";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        // admin assets
        "resources/views/assets/js/app.js",
        "resources/views/assets/sass/app.scss",
        "resources/css/filament/admin/theme.css",
      ],
      refresh: [
        // Only refresh on blade/php file changes, not Vue files
        "resources/views/**/*.blade.php",
        "app/Http/Livewire/**",
        "routes/**",
        "app/View/Components/**",
      ],
    }),
    vue({
      template: {
        compilerOptions: {
          // Remove comments and whitespace in production
          comments: false,
        },
      },
    }),
    svgLoader({
      svgoConfig: {
        multipass: true,
      },
    }),
    Components({
      globs: ["resources/views/assets/js/components/**/*.vue"],
      resolvers: [PrimeVueResolver()],
    }),
    vueDevTools(),
    // Uncomment to analyze bundle size
    // visualizer({
    //     open: true,
    //     gzipSize: true,
    //     brotliSize: true,
    // })
  ],
  resolve: {
    alias: {
      "@": resolve(__dirname, "resources/js"),
      "@composables": resolve(
        __dirname,
        "resources/views/assets/js/composables",
      ),
      "&": resolve(__dirname, "resources/svg"),
      "~fonts": resolve(__dirname, "public/fonts"),
      vue: "vue/dist/vue.esm-bundler.js",
    },
  },
  build: {
    rollupOptions: {
      output: {
        manualChunks(id) {
          if (!id.includes("node_modules")) return;
          // Separate PrimeVue components
          if (id.includes("primevue/config")) return "primevue-core";
          // Separate large libraries
          if (id.includes("/leaflet/") || id.includes("@vue-leaflet/vue-leaflet"))
            return "leaflet";
          if (id.includes("@tiptap/")) return "tiptap";
          // Vendor chunk for common dependencies
          if (
            id.includes("/vue/") ||
            id.includes("/axios/") ||
            id.includes("/alpinejs/")
          )
            return "vendor";
        },
      },
    },
    // Enable minification
    minify: "terser",
    terserOptions: {
      compress: {
        drop_console: true, // Remove console.log in production
        drop_debugger: true,
        pure_funcs: ["console.log", "console.info"],
      },
    },
    // Adjust chunk size warnings
    chunkSizeWarningLimit: 600,
    // Enable CSS code splitting
    cssCodeSplit: true,
  },
});
