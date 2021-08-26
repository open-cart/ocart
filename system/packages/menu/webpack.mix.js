const mix = require('laravel-mix');
const glob = require('glob');

const resourcePath = 'system/packages/menu/';
const publicPath = 'public/vendor/packages/menu/';

mix.js(resourcePath + 'resources/assets/js/nestable.menu.js', publicPath + 'js')
    .copy(publicPath + 'js/', resourcePath + 'public/js');

mix.css(resourcePath + 'resources/assets/css/nestable.css', publicPath + 'css')
    .copy(publicPath + 'css/', resourcePath + 'public/css');