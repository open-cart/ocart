<?php
namespace Ocart\Payment\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Payment\Repositories\PaymentRepository;
use Ocart\Payment\Repositories\PaymentRepositoryEloquent;

class HookServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
    }

    public function boot()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-payments',
                'priority' => 3,
                'parent_id' => null,
                'name' => trans('plugins/payment::payment.menu.payments'),
                'icon' => null,
                'url' => '',
                'permissions' => [],
                'active' => false,
            ])->registerItem([
                'id'          => 'cms-payment-transaction',
                'priority'    => 1,
                'parent_id'   => 'cms-payments',
                'name'        => trans('plugins/payment::payment.menu.transaction'),
                'icon'        => null,
                'url'         => route('payments.transactions.index'),
                'permissions' => [
                    'ecommerce.orders.index',
                ],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-payment-methods',
                'priority'    => 1,
                'parent_id'   => 'cms-payments',
                'name'        => trans('plugins/payment::payment.menu.payment_method'),
                'icon'        => null,
                'url'         => route('payments.methods.index'),
                'permissions' => [
                    'ecommerce.orders.index',
                ],
                'active'      => false,
            ]);
        });
    }
}