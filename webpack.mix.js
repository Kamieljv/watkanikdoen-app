const mix = require('laravel-mix');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');

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
mix.js('resources/js/app.js', 'admin/js')
    .vue()
    .sass('resources/sass/app.scss', 'admin/css');

// public
mix.js('resources/views/themes/custom/assets/js/app.js', 'themes/custom/js')
    .sass('resources/views/themes/custom/assets/sass/wave.scss', 'themes/custom/css')
	.tailwind('./tailwind.config.js');