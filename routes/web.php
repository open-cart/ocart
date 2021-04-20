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

Route::get('/notification', function () {
//    \Illuminate\Support\Facades\Notification::send(\App\Models\User::first(), new \App\Notifications\InvoicePaid());
    \Illuminate\Support\Facades\Notification::route('telegram', '-1001326089934')
        ->notify(new \App\Notifications\InvoicePaid());
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
