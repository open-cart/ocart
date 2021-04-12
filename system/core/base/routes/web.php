<?php
use \Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
        'namespace' => 'Ocart\\Core\\Http\\Controllers',
    ],
    function() {
        Route::get('/mailable', function () {
            return \Ocart\Core\Facades\EmailHandler::create(\Illuminate\Support\Facades\Mail::to('nguyen@gmail.com'))
                ->preview()
                ->sendUsingTemplate('plugins.contact::emails.contact', [
                    'contact_content' => 'nguen'
                ]);
        });

        Route::get('/location/district', 'LocationController@getDistrict')
            ->name('location.district');


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

//        foreach (glob(__DIR__.'/Routes/*.php') as $filename) {
//            require_once $filename;
//        }
    });
