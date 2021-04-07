<?php

use Illuminate\Support\Facades\Route;

Route::get('nguyen', function() {
    return Theme::layout('guest')->scope('test-page');
});
