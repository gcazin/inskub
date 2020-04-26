const mix = require('laravel-mix');
const tailwindcss = require ('tailwindcss');

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

mix.sass('resources/scss/bootstrap.scss', 'public/css')
    .options({
        processCssUrls: false,
    });

mix.js('resources/bootstrap/js/src/index.js', 'public/js')
