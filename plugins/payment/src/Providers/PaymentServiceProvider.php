<?php
namespace Ocart\Payment\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Payment\Repositories\PaymentRepository;
use Ocart\Payment\Repositories\PaymentRepositoryEloquent;

class PaymentServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(PaymentRepository::class, PaymentRepositoryEloquent::class);
    }

    public function boot()
    {
        $this
            ->setBasePath(base_path() .'/')
            ->setNamespace('plugins/payment')
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations();
    }
}