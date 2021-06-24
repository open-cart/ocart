<?php
namespace Ocart\Stripe\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Payment\Enums\PaymentMethodEnum;

class HookServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        add_filter(BASE_FILTER_ENUM_ARRAY, function ($values, $class) {
            if ($class == PaymentMethodEnum::class) {
                $values['STRIPE'] = 'stripe';
            }

            return $values;
        }, 23, 2);

        add_filter(PAYMENT_FILTER_ADDITIONAL_PAYMENT_METHODS, [$this, 'registerStripeMethod'], 17, 2);
        add_filter(PAYMENT_METHODS_SETTINGS_PAGE, [$this, 'addPaymentSettings'], 99);
    }

    public function boot()
    {
        $this
            ->setBasePath(base_path() .'/')
            ->setNamespace('plugins/stripe')
//            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations();
    }

    public function registerStripeMethod($html, $data)
    {
        return $html . view('plugins.stripe::method', $data);
    }

    public function addPaymentSettings($html)
    {
        return $html . view('plugins.stripe::setting');
    }
}