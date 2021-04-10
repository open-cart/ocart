<?php

use Illuminate\Support\Facades\Route;

Route::get('nguyen', function() {
    return Theme::layout('guest')->scope('test-page');
});

Route::group([
    'middleware' => 'web'
],
    function(){
        Route::get('user-profile', function () {
            return Theme::layout('default')->scope('user-profile');
        })->name('user-profile')->middleware(['auth']);
    });