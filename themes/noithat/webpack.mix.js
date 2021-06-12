const mix = require('laravel-mix');

const resourcePath = 'themes/noithat/';
const publicPath = 'public/themes/noithat/';

mix.postCss(resourcePath + 'assets/css/style.css', publicPath + 'css', [
    require('postcss-import'),
    require('tailwindcss')('./themes/noithat/tailwind.config.js'),
    require('autoprefixer')
]).copy(publicPath + 'css/', resourcePath + 'public/css');
