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

mix.js('resources/js/admin/app.js', 'public/js/admin').vue()
    .js('resources/js/web/app.js', 'public/js/web').vue()
    .less('resources/css/admin/app.less', 'public/css/admin')
    .less('resources/css/web/app.less', 'public/css/web');

