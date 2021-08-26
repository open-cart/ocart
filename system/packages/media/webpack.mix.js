const mix = require('laravel-mix');
const glob = require('glob');

const resourcePath = 'system/packages/media/';
const publicPath = 'public/vendor/packages/media/';

mix.js(resourcePath + 'resources/js/app.js', publicPath + 'js')
    .copy(publicPath + 'js/', resourcePath + 'public/js');

mix.css(resourcePath + 'resources/css/app.css', publicPath + 'css')
    .copy(publicPath + 'css/', resourcePath + 'public/css');