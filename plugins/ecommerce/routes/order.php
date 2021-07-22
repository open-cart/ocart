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

                Route::get('generate-invoice/{id}', [
                    'as'         => 'generate-invoice',
                    'uses'       => 'OrderController@getGenerateInvoice',
                    'permission' => 'orders.edit',
                ]);

                Route::resource('', 'OrderController')->parameters(['' => 'id']);

                Route::post('get-available-shipping-methods', 'OrderController@getAvailableShippingMethods')
                ->name('get_available_shipping_methods');

                Route::post('comment', 'OrderController@postComment')
                    ->name('comment');

                Route::delete('delete-comment', 'OrderController@postDeleteComment')
                    ->name('delete_comment');

                Route::post('cancel-order/{id}', 'OrderController@postCancelOrder')
                    ->name('cancel_order');

            });

            Route::group(['prefix' => 'reports', 'as' => 'report.'], function () {
                Route::get('dashboard-general-report', [
                    'as'         => 'dashboard-widget.general',
                    'uses'       => 'ReportController@getDashboardWidgetGeneral',
                    'permission' => 'ecommerce.report.index',
                ]);
            });
        });
//        Route::post('shopping-buy', 'OrderController@buy')->name(ROUTE_SHOPPING_BUY_SCREEN_NAME);
    });
