<?php

use \Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => config('const.ADMIN_PREFIX', 'admin'),
        'middleware' => config('const.ADMIN_MIDDLEWARE', ['web']),
        'namespace' => config('const.ADMIN_NAMESPACE', 'System\\Core\\Admin\\Controllers'),
    ],
    function() {
        Route::get('/theme/red', function () {
            session(['theme' => 'themes.red']);
            return back();
        })->name('theme::red');
        Route::get('/theme/blue', function () {
            session(['theme' => 'themes.blue']);
            return back();
        })->name('theme::blue');

        Route::get('/theme/green', function () {
            session(['theme' => 'themes.green']);
            return back();
        })->name('theme::green');

        Route::get('/theme/black', function () {
            session(['theme' => 'themes.black']);
            return back();
        })->name('theme::black');


        Route::get('/language/vi', function () {
            session(['language' => 'vi']);
            return back();
        })->name('language::vi');

        Route::get('/language/en', function () {
            session(['language' => 'en']);
            return back();
        })->name('language::en');


        Route::get('/', function() {
            return view('admin.page');
        })->name('admin:home');
        Route::get('/orders', function() {
            echo 'nguyen';
            die;
        })->name('admin::order');

        Route::get('/pages', function() {
            return view('admin.page');
        })->name('admin::page');

        Route::get('/blogs', function() {
            echo 'nguyen';
            die;
        })->name('admin::blog');

        foreach (glob(__DIR__.'/Routes/*.php') as $filename) {
            require_once $filename;
        }
});
