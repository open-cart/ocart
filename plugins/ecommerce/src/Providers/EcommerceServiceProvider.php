<?php
namespace Ocart\Ecommerce\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Ecommerce\Repositories\BrandRepositoryEloquent;
use Ocart\Ecommerce\Repositories\CategoryRepositoryEloquent;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\TagRepository;
use Ocart\Ecommerce\Repositories\ProductRepositoryEloquent;
use Ocart\Ecommerce\Repositories\TagRepositoryEloquent;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class EcommerceServiceProvider extends ServiceProvider {
    use  LoadAndPublishDataTrait;

    public function register()
    {

        $this
            ->setBasePath(base_path() .'/')
            ->setNamespace('plugins/ecommerce')
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadMigrations();

        $this->app->bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(TagRepository::class, TagRepositoryEloquent::class);
        $this->app->bind(BrandRepository::class, BrandRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
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
            ])
//                ->registerItem([
//                'id'          => 'cms-store-report',
//                'priority'    => 1,
//                'parent_id'   => 'cms-store',
//                'name'        => 'Báo cáo',
//                'icon'        => null,
//                'url'         => '',
//                'permissions' => [],
//                'active'      => false,
//            ])->registerItem([
//                'id'          => 'cms-store-order',
//                'priority'    => 1,
//                'parent_id'   => 'cms-store',
//                'name'        => 'Đơn hàng',
//                'icon'        => null,
//                'url'         => '',
//                'permissions' => [],
//                'active'      => false,
//            ])
//                ->registerItem([
//                'id'          => 'cms-store-incomplete-order',
//                'priority'    => 1,
//                'parent_id'   => 'cms-store',
//                'name'        => 'incomplete orders',
//                'icon'        => null,
//                'url'         => '',
//                'permissions' => [],
//                'active'      => false,
//            ])
                ->registerItem([
                'id'          => 'cms-store-product-manager',
                'priority'    => 1,
                'parent_id'   => 'cms-store',
                'name'        => 'Sản phẩm',
                'icon'        => null,
                'url'         => route('ecommerce.products.index'),
                'permissions' => [
                    'ecommerce.products.index',
                    'ecommerce.products.create',
                    'ecommerce.products.update',
                    'ecommerce.products.destroy',
                ],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-store-product-category-manager',
                'priority'    => 1,
                'parent_id'   => 'cms-store',
                'name'        => 'Danh mục sản phẩm',
                'icon'        => null,
                'url'         => route('ecommerce.categories.index'),
                'permissions' => [
                    'ecommerce.categories.index',
                    'ecommerce.categories.create',
                    'ecommerce.categories.update',
                    'ecommerce.categories.destroy',
                ],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-store-product-tag-manager',
                'priority'    => 1,
                'parent_id'   => 'cms-store',
                'name'        => 'Product Tags',
                'icon'        => null,
                'url'         => route('ecommerce.tags.index'),
                'permissions' => [
                    'ecommerce.tags.index',
                    'ecommerce.tags.create',
                    'ecommerce.tags.update',
                    'ecommerce.tags.destroy',
                ],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-store-brand-manager',
                'priority'    => 1,
                'parent_id'   => 'cms-store',
                'name'        => 'Brands',
                'icon'        => null,
                'url'         => route('ecommerce.brands.index'),
                'permissions' => [
                    'ecommerce.brands.index',
                    'ecommerce.brands.create',
                    'ecommerce.brands.update',
                    'ecommerce.brands.destroy',
                ],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-store-setting-manager',
                'priority'    => 1,
                'parent_id'   => 'cms-store',
                'name'        => 'Settings',
                'icon'        => null,
                'url'         => '',
                'permissions' => [],
                'active'      => false,
            ]);
        });
    }
}
