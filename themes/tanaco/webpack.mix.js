const mix = require('laravel-mix');

const resourcePath = 'themes/tanaco/';
const publicPath = 'public/themes/tanaco/';

mix.postCss(resourcePath + 'assets/css/style.css', publicPath + 'css', [
    require('postcss-import'),
    require('tailwindcss')('./themes/tanaco/tailwind.config.js'),,
    require('autoprefixer')
]).copy(publicPath + 'css/', resourcePath + 'public/css');