const mix = require('laravel-mix');
const glob = require('glob');

const resourcePath = 'system/core/base/';
const publicPath = 'public/vendor/core/base/';

mix.js(resourcePath + 'resources/assets/js/editor.js', publicPath + 'js')
    .copy(publicPath + 'js/', resourcePath + 'public/js');

// mix.css(resourcePath + 'resources/css/app.css', publicPath + 'css')
//     .copy(publicPath + 'css/', resourcePath + 'public/css');