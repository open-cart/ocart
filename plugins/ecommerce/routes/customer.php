<?php

use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'web',
    'namespace' => 'Ocart\Ecommerce\Http\Controllers\Customers',
],
function(){
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
        'as' => 'ecommerce.'
    ], function () {
//        Route::group(['prefix'=>'orders', 'as' => 'orders.'], function () {
//            Route::resource('', 'OrderController')->parameters(['' => 'id']);
//        });

        Route::group(['prefix'=>'customers', 'as' => 'customers.'], function () {
            Route::get('search-customer', 'CustomerController@getSearchCustomers')->name('search');
            Route::get('get-customer-addresses', 'CustomerController@getCustomerAddresses')->name('get-customer-addresses');
            Route::post('create-customer-when-creating-order', 'CustomerController@postCreateCustomerWhenCreatingOrder')
                ->name('create-customer-when-creating-order');

            Route::resource('', 'CustomerController')->parameters(['' => 'id']);
        });
    });
});

