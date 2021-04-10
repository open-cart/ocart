<?php

use Illuminate\Support\Facades\Route;

Route::get('nguyen', function() {
    return Theme::layout('guest')->scope('test-page');
});
Route::get('shopping-cart', function() {
    return Theme::layout('default')->scope('shopping-cart');
})->name('shopping-cart');
Route::get('shopping-buy', function() {
    return Theme::layout('default')->scope('shopping-buy');
})->name('shopping-buy');
Route::get('shopping-thank', function() {
    return Theme::layout('default')->scope('shopping-thank');
})->name('shopping-thank');

Route::group([
    'middleware' => 'web'
],
    function(){
        Route::get('user-profile', function () {
            return Theme::layout('default')->scope('user-profile');
        })->name('user-profile')->middleware(['auth']);
    });