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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
    // require('toastr')
]);
mix.sass('resources/css/swal.scss', 'public/css')

mix.browserSync({
    proxy: 'https://ocart.test/',
    files: [
        "**/*.css",
        "**/*.php",
        "**/*.js",
    ]
});
