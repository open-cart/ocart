<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Ocart\Attribute\Http\Controllers',
], function () {
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
    ], function () {
        Route::group(['prefix'=>'attribute_groups', 'as' => 'ecommerce.attribute_groups.'], function () {
            Route::resource('', 'ProductAttributeGroupController')->parameters(['' => 'id']);
        });

        Route::post('product_version/add_version', 'ProductController@addVersion')
            ->name('ecommerce.attribute_groups.add_version');

        Route::patch('product_version/update_version', 'ProductController@updateVersion')
            ->name('ecommerce.attribute_groups.update_version');
        Route::post('product_version/update_version/{id}', 'ProductController@updateVersion');

        Route::patch('product_version/get_version', 'ProductController@getVersion')
            ->name('ecommerce.attribute_groups.get_version');
        Route::get('product_version/get_version/{id}', 'ProductController@getVersion');

        Route::delete('product_version/delete_version', 'ProductController@deleteVersion')
            ->name('ecommerce.attribute_groups.delete_version');

    });
});
