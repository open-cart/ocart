<?php

use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'web',
    'namespace' => 'Ocart\Ecommerce\Http\Controllers',
],
    function(){
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
        'as' => 'ecommerce.'
    ], function () {
        Route::group(['prefix'=>'settings'], function () {
            Route::get('settings', 'EcommerceController@getSettings')->name('settings');
            Route::post('settings', 'EcommerceController@postSettings')->name('settings');
        });

        Route::group(['prefix'=>'currencies', 'as' => 'currencies.'], function () {
            Route::resource('', 'CurrencyController')->parameters(['' => 'id']);
        });

        Route::group(['prefix'=>'products', 'as' => 'products.'], function () {
            Route::get('search-product', 'ProductController@getSearchProducts')->name('search');

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

    Route::get('product/{id}', 'PublicController@product');
    Route::get('product-category/{id}', 'PublicController@productCategory');
    Route::get('shopping-cart', 'ShoppingController@cart')->name('shopping-cart');
    Route::get('shopping-buy', 'ShoppingController@buy')->name('shopping-buy');
    Route::get('shopping-thank', 'ShoppingController@thank')->name('shopping-thank');

    Route::post('add-to-cart', 'ShoppingController@add')->name('add-to-cart');
    Route::post('remove-to-cart', 'ShoppingController@remove')->name('remove-to-cart');
    Route::post('update-to-cart', 'ShoppingController@update')->name('update-to-cart');

});

