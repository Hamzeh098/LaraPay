const mix = require('laravel-mix');

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

mix.styles([
    'resources/css/lib/bootstrap/bootstrap-rtl.min.css',
    'resources/css/helper.css',
    'resources/css/fonts.css',
    'resources/css/style.css',
], 'public/css/admin.min.css');

mix.scripts([
    'resources/js/lib/bootstrap/js/popper.min.js',
    'resources/js/lib/bootstrap/js/bootstrap.min.js',
    'resources/js/jquery.slimscroll.js',
    'resources/js/sidebarmenu.js',
    'resources/js/lib/sticky-kit-master/dist/sticky-kit.min.js',
    'resources/js/custom.min.js',
], 'public/js/admin.min.js');

mix.js('resources/js/bootstrap.js', 'public/js/rt.min.js');
