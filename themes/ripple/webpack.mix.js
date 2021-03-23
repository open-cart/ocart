const mix = require('laravel-mix');

const resourcePath = 'themes/ripple/';
const publicPath = 'public/themes/ripple/';

mix.postCss(resourcePath + 'assets/css/style.css', publicPath + 'css')
    .copy(publicPath + 'css/', resourcePath + 'public/css');