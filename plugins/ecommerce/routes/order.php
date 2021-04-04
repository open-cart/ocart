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
                Route::resource('', 'OrderController')->parameters(['' => 'id']);
            });
        });
    });

