<?php

use Illuminate\Support\Facades\Route;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Models\Category;
use Ocart\Ecommerce\Models\Tag;
use Ocart\Core\Facades\Slug;

Route::group([
    'middleware' => 'web',
    'namespace' => 'Ocart\Ecommerce\Http\Controllers',
],
    function(){
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
        'as' => 'ecommerce.'
    ],
        function () {
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

        Route::group(['prefix'=>'product-taxes', 'as' => 'taxes.'], function () {
            Route::resource('', 'TaxController')->parameters(['' => 'id']);
        });

        Route::group(['prefix'=>'product-categories', 'as' => 'categories.'], function () {
            Route::resource('', 'CategoryController')->parameters(['' => 'id']);
        });

        Route::get('product_ajax_search_tags', 'TagController@ajaxSearchTags')
            ->name('product_ajax_search_tags');
    });
});

Route::group([
    'middleware' => 'web',
    'namespace' => 'Ocart\Ecommerce\Http\Controllers\Front',
], function () {
    Route::get(Slug::getPrefix(Product::class, 'product') . '/{slug}', [
        'uses' => 'PublicController@product',
        'as' => ROUTE_PRODUCT_SCREEN_NAME
    ]);

    Route::get(Slug::getPrefix(Category::class, 'product-category') .'/{slug}', [
        'uses' => 'PublicController@productCategory',
        'as' => ROUTE_PRODUCT_CATEGORY_SCREEN_NAME
    ]);

    Route::get(Slug::getPrefix(Tag::class, 'product-tag') .'/{slug}', [
        'uses' => 'PublicController@productTag',
        'as' => ROUTE_PRODUCT_TAG_SCREEN_NAME
    ]);

    Route::get('shop', 'PublicController@shop')->name(ROUTE_SHOP_SCREEN_NAME);

    Route::get('bill', 'PublicController@bill')->name(ROUTE_BILL_SCREEN_NAME);

    Route::get('shopping-cart', 'ShoppingController@cart')->name(ROUTE_SHOPPING_CART_SCREEN_NAME);

    Route::get('shopping-buy', 'CheckoutController@getCheckout')->name(ROUTE_SHOPPING_BUY_SCREEN_NAME);
    Route::post('shopping-buy', 'CheckoutController@postCheckout');

    Route::get('shopping-thank', 'ShoppingController@thank')->name(ROUTE_SHOPPING_THANK_SCREEN_NAME);

    Route::post('add-to-cart', 'ShoppingController@add')->name(ROUTE_ADD_TO_CART_NAME);
    Route::post('remove-to-cart', 'ShoppingController@remove')->name(ROUTE_REMOVE_TO_CART_NAME);
    Route::post('update-to-cart', 'ShoppingController@update')->name(ROUTE_UPDATE_TO_CART_NAME);
});
