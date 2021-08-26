const mix = require('laravel-mix');
const glob = require('glob');

const resourcePath = 'system/core/dashboard/';
const publicPath = 'public/vendor/core/dashboard/';

mix.js(resourcePath + 'resources/js/dashboard.js', publicPath + 'js')
    .copy(publicPath + 'js/', resourcePath + 'public/js');
