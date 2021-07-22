const mix = require('laravel-mix');
const glob = require('glob');

const resourcePath = 'system/core/dashboard/';
const publicPath = 'public/vendors/core/dashboard/';

mix.js(resourcePath + 'resources/js/dashboard.js', publicPath + 'js')
    .copy(publicPath + 'js/', resourcePath + 'public/js');

// mix.postCss(resourcePath + 'assets/css/style.css', publicPath + 'css', [
//     require('postcss-import'),
//     require('tailwindcss')('./themes/noithat/tailwind.config.js'),
//     require('autoprefixer')
// ]).copy(publicPath + 'css/', resourcePath + 'public/css');
