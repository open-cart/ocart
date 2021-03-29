const mix = require('laravel-mix');

const resourcePath = 'themes/group/';
const publicPath = 'public/themes/group/';

mix.postCss(resourcePath + 'assets/css/style.css', publicPath + 'css', [
    require('postcss-import'),
    require('tailwindcss')('./themes/ripple/tailwind.config.js'),,
    require('autoprefixer')
]).copy(publicPath + 'css/', resourcePath + 'public/css');