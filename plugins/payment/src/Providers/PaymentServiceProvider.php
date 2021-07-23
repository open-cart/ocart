<?php

namespace Ocart\Payment\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Payment\Repositories\Caches\PaymentCacheDecorator;
use Ocart\Payment\Repositories\PaymentRepository;

class PaymentServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(PaymentRepository::class, PaymentCacheDecorator::class);
    }

    public function boot()
    {
        $this
            ->setBasePath(base_path() . '/')
            ->setNamespace('plugins/payment')
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations();
    }
}