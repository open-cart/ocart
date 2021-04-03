<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/install-migrate', function () {
//    \Illuminate\Support\Facades\Artisan::call('migrate');
//    \Illuminate\Support\Facades\Artisan::call('key:generate');
//    \Illuminate\Support\Facades\Artisan::call('db:seed');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
