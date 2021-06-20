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
            Route::group(['prefix'=>'orders', 'as' => 'orders.'], function () {
                Route::post('confirm', 'OrderController@postConfirmOrder')
                    ->name('confirm');
                Route::post('confirm-payment', 'OrderController@postConfirmPayment')
                    ->name('confirm-payment');
                Route::post('update-shipping-address/{id}', 'OrderController@postUpdateShippingAddress')
                    ->name('update-shipping-address');
                Route::post('mark-as-fulfilled/{id}', 'OrderController@postMarkAsFulfilled')
                    ->name('mark-as-fulfilled');
                Route::post('refund/{id}', 'OrderController@postRefund')
                    ->name('refund');



                Route::resource('', 'OrderController')->parameters(['' => 'id']);

                Route::post('get-available-shipping-methods', 'OrderController@getAvailableShippingMethods')
                ->name('get_available_shipping_methods');

                Route::post('post-comment', 'OrderController@postComment')
                    ->name('post_comment');
            });
        });
        Route::post('shopping-buy', 'OrderController@buy')->name(ROUTE_SHOPPING_BUY_SCREEN_NAME);

    });
