<?php

namespace System\Core;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\ResourceRegistrar;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Prettus\Repository\Criteria\RequestCriteria;
use System\Core\Library\CustomResourceRegistrar;
use System\Core\Repositories\MetaBoxRepository;
use System\Core\Repositories\MetaBoxRepositoryEloquent;
use System\Core\Traits\LoadAndPublishDataTrait;

class CoreServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        parent::register();
        foreach (glob(__DIR__.'/../helpers/*.php') as $filename) {
            require_once $filename;
        }

//        $this->app->bind(LengthAwarePaginator::class, CustomPaginator::class);
        $this->app->bind(ResourceRegistrar::class, CustomResourceRegistrar::class);
        $this->app->bind(MetaBoxRepository::class, MetaBoxRepositoryEloquent::class);
        $this->app->bind(RequestCriteria::class, \System\Core\Criteria\RequestCriteria::class);


        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');
    }

    public function boot()
    {
        $this->setNamespace('core/base')->loadMigrations();

        // Route Admin
        if (file_exists(__DIR__ . '/../routes/web.php')) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        }

        function featherIcon($name) {
            return '<i data-feather="'.$name.'"></i>';
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-store',
                'priority'    => 1,
                'parent_id'   => null,
                'name'        => 'Cửa hàng',
                'icon'        => featherIcon('shopping-cart'),
                'url'         => '',
                'permissions' => [],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-store-order',
                'priority'    => 1,
                'parent_id'   => 'cms-store',
                'name'        => 'Quản lý đơn hàng',
                'icon'        => null,
                'url'         => '',
                'permissions' => [],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-store-order-manager',
                'priority'    => 1,
                'parent_id'   => 'cms-store-order',
                'name'        => 'Quản lý đơn hàng',
                'icon'        => null,
                'url'         => '',
                'permissions' => [],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-store-product',
                'priority'    => 1,
                'parent_id'   => 'cms-store',
                'name'        => 'Sản phẩm & danh mục',
                'icon'        => null,
                'url'         => '',
                'permissions' => [],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-store-product-manager',
                'priority'    => 1,
                'parent_id'   => 'cms-store-product',
                'name'        => 'Quản lý sản phẩm',
                'icon'        => null,
                'url'         => '',
                'permissions' => [],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-store-product-category-manager',
                'priority'    => 1,
                'parent_id'   => 'cms-store-product',
                'name'        => 'Quản lý danh mục',
                'icon'        => null,
                'url'         => '',
                'permissions' => [],
                'active'      => false,
            ]);
        });
    }
}
