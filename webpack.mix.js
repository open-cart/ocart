const mix = require('laravel-mix');
const glob = require('glob');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */


glob.sync('./system/**/webpack.mix.js').forEach(config => {
    require(config);
});

glob.sync('./themes/**/webpack.mix.js').forEach(config => {
    require(config);
});

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss')('./tailwind.config.js'),
    require('autoprefixer')
]);
mix.sass('resources/css/swal.scss', 'public/css')

mix.browserSync({
    proxy: 'http://127.0.0.1:8000/',
    files: [
        "**/*.css",
        "**/*.php",
        "**/*.js",
    ]
});
