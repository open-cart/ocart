const mix = require('laravel-mix');

const resourcePath = 'themes/nguyenanh/';
const publicPath = 'public/themes/nguyenanh/';

mix.postCss(resourcePath + 'assets/css/style.css', publicPath + 'css', [
    require('postcss-import'),
    require('tailwindcss')('./themes/nguyenanh/tailwind.config.js'),
    require('autoprefixer')
]).copy(publicPath + 'css/', resourcePath + 'public/css');