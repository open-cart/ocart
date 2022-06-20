<?php

use Illuminate\Support\Facades\Route;
use Ocart\Blog\Repositories\Caches\PostCacheDecorator;
use Ocart\Core\Facades\EmailHandler;
use App\Http\Controllers\HomeController;

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

Route::get('nguyencache', function () {
    $a = new PostCacheDecorator(app(\Ocart\Blog\Repositories\PostRepositoryEloquent::class));
    dd($a->all());
});

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

Route::get('testEamil', function () {
    $order  = \Ocart\Ecommerce\Models\Order::first();
    EmailHandler::module('ecommerce')->setVariableValues([
        'store_address'    => get_ecommerce_setting('store_address'),
        'store_phone'      => get_ecommerce_setting('store_phone'),
        'order_id'         => str_replace('#', '', $order->code),
        'order_token'      => $order->token,
        'customer_name'    => $order->user->name ? $order->user->name : $order->address->name,
        'customer_email'   => $order->user->email ? $order->user->email : $order->address->email,
        'customer_phone'   => $order->user->phone ? $order->user->phone : $order->address->phone,
        'customer_address' => $order->address->address . ', ' . $order->address->city . ', ' . $order->address->country_name,
        'product_list'     => view('plugins.ecommerce::emails.partials.order-detail',
            compact('order'))->render(),
        'shipping_method'  => $order->shipping_method_name,
        'payment_method'   => $order->payment->payment_channel->label(),
    ]);

    return EmailHandler::module('ecommerce')
        ->preview()
        ->sendUsingTemplate('plugins.ecommerce::emails.order_recover');
});

Route::get('change-language/{language}', [HomeController::class, 'changeLanguage'] )->name('user.change-language');

require __DIR__.'/auth.php';
