const mix = require('laravel-mix');

const resourcePath = 'themes/ripple/';
const publicPath = 'public/themes/ripple/';

mix.postCss(resourcePath + 'assets/css/style.css', publicPath + 'css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
])
    .copy(publicPath + 'css/', resourcePath + 'public/css');
mix.postCss(resourcePath + 'assets/css/tailwind.css', publicPath + 'css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
]).copy(publicPath + 'css/', resourcePath + 'public/css');