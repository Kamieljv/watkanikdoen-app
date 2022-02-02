const mix = require('laravel-mix');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');
require('laravel-mix-svg-vue');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


// mix assets for the multiple sections (public section/admin section)

// admin
mix.js('resources/js/app.js', 'js')
    .vue()
    .sass('resources/sass/app.scss', 'css');

// public
mix.js('resources/views/assets/js/app.js', 'frontend/js')
    .sass('resources/views/assets/sass/app.scss', 'frontend/css')
	.tailwind('./resources/views/tailwind.config.js')
    .copyDirectory('resources/fonts', 'public/fonts')
    .svgVue()
    .version();