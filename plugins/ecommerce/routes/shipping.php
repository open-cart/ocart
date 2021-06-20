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
        Route::group(['prefix'=>'shipping', 'as' => 'shipping.'], function () {
            Route::get('shipping-methods', 'ShippingController@index')
                ->name('shipping_methods');
            Route::post('add-shipping-region', 'ShippingController@addShippingRegion')
                ->name('add_shipping_region');
            Route::delete('delete-shipping-region', 'ShippingController@deleteShippingRegion')
                ->name('delete_shipping_region');
            Route::post('add-shipping-rule', 'ShippingController@addShippingRule')
                ->name('add_shipping_rule');
            Route::post('update-shipping-rule', 'ShippingController@updateShippingRule')
                ->name('update_shipping_rule');
            Route::delete('delete-shipping-rule', 'ShippingController@deleteShippingRule')
                ->name('delete_shipping_rule');
        });
    });
});

