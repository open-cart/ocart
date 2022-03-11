<?php

use Illuminate\Support\Facades\Route;
use Ocart\Ecommerce\Http\Controllers\Customers\CustomerController;

Route::group([
    'middleware' => 'web',
    'namespace' => '',
],
    function () {
        Route::group([
            'prefix' => ADMIN_PREFIX,
            'middleware' => ADMIN_MIDDLEWARE,
            'as' => 'ecommerce.'
        ], function () {
            Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
                Route::get('search-customer', [CustomerController::class, 'getSearchCustomers'])
                    ->name('search');
                Route::get('get-customer-addresses', [CustomerController::class, 'getCustomerAddresses'])
                    ->name('get-customer-addresses');
                Route::post('create-customer-when-creating-order', [CustomerController::class, 'postCreateCustomerWhenCreatingOrder'])
                    ->name('create-customer-when-creating-order');

                Route::resource('', CustomerController::class)->parameters(['' => 'id']);
            });
        });
    });

