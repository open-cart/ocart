<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Ecommerce\Http\Controllers',
], function () {
    Route::group(['prefix'=>'product', 'as' => 'products.'], function () {
        Route::resource('', 'ProductController')->parameters(['' => 'id']);
    });
});
