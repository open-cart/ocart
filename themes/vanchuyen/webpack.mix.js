const mix = require('laravel-mix');

const resourcePath = 'themes/vanchuyen/';
const publicPath = 'public/themes/vanchuyen/';

mix.postCss(resourcePath + 'assets/css/style.css', publicPath + 'css', [
    require('postcss-import'),
    require('tailwindcss')('./themes/vanchuyen/tailwind.config.js'),
    require('autoprefixer')
]).copy(publicPath + 'css/', resourcePath + 'public/css');

mix.postCss(resourcePath + 'assets/css/speed.css', publicPath + 'css', [
]).copy(publicPath + 'css/', resourcePath + 'public/css');
