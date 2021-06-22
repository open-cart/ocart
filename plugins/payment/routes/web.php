<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'web',
    'namespace' => 'Ocart\Payment\Http\Controllers',
], function() {
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
        'as' => 'payments.'
    ], function () {
        Route::group(['prefix' => 'payments'], function () {
            Route::group(['prefix'=>'transactions', 'as' => 'transactions.'], function () {
                Route::resource('', 'PaymentTransactionController')->parameters(['' => 'id']);
            });
//            Route::get('transactions', 'PaymentTransactionController@index')->name('transactions.index');
            Route::get('methods', 'PaymentMethodController@index')->name('methods.index');
        });
    });
});