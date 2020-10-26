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

mix.sass('resources/assets/scss/bootstrap.scss', 'public/css')
    .options({
        processCssUrls: false,
    });

mix.js('resources/assets/js/app.js', 'public/js')

mix.scripts([
    'public/js/ajax.js'
], 'public/js/ajax.js')
