<?php

use Illuminate\Support\Facades\Route;

Route::get('nguyen', function() {
    return Theme::layout('guest')->scope('test-page');
});
Route::get('shopping-buy', function() {
    return Theme::layout('default')->scope('shopping-buy');
})->name('shopping-buy');
Route::get('shopping-thank', function() {
    return Theme::layout('default')->scope('shopping-thank');
})->name('shopping-thank');
