const mix = require('laravel-mix');

const resourcePath = 'themes/ximang/';
const publicPath = 'public/themes/ximang/';

mix.postCss(resourcePath + 'assets/css/style.css', publicPath + 'css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
])
    .copy(publicPath + 'css/', resourcePath + 'public/css');
