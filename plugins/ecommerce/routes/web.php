<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Ecommerce\Http\Controllers',
], function () {
    Route::group(['prefix'=>'products', 'as' => 'products.'], function () {
        Route::resource('', 'ProductController')->parameters(['' => 'id']);
    });

    Route::group(['prefix'=>'product-tags', 'as' => 'tags.'], function () {
        Route::resource('', 'TagController')->parameters(['' => 'id']);
    });

    Route::group(['prefix'=>'product-brands', 'as' => 'brands.'], function () {
        Route::resource('', 'BrandController')->parameters(['' => 'id']);
    });

    Route::group(['prefix'=>'product-categories', 'as' => 'categories.'], function () {
        Route::resource('', 'CategoryController')->parameters(['' => 'id']);
    });
});