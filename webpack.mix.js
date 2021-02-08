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

const tailWindCss = require('tailwindcss')

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css').options({
        processCssUrls:false,
        postCss:[tailWindCss('./tailwind.config.js')]
    });
mix.webpackConfig({
    output: {
        chunkFilename: 'js/vuejs_code_split/[name].js',
    }
});
