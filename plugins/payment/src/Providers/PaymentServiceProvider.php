<?php
namespace Ocart\Payment\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Payment\Repositories\PaymentRepository;
use Ocart\Payment\Repositories\PaymentRepositoryEloquent;

class PaymentServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(PaymentRepository::class, PaymentRepositoryEloquent::class);
    }
}