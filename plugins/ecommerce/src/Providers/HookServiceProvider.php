<?php


namespace Ocart\Ecommerce\Providers;


use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Ocart\Contact\Repositories\Interfaces\ContactRepository;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Ecommerce\Models\Brand;
use Ocart\Ecommerce\Models\Category;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Widgets\ProductStatsWidget;

class HookServiceProvider extends ServiceProvider
{

    /**
     * @var Collection
     */
    protected $pendingOrders = [];

    public function register()
    {
    }

    public function boot()
    {
        add_dashboard_widget()
            ->setTitle('Products')
            ->setKey('product_stats_widget')
            ->setIcon('fa fa-file-text')
            ->create(ProductStatsWidget::class);

        $this->registerMenu();

        add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions']);

        $this->booted(function () {
            add_filter(BASE_FILTER_TOP_HEADER_LAYOUT, [$this, 'registerTopHeaderNotification'], 120);
        });
    }

    protected function registerMenu()
    {

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-store',
                'priority'    => 1,
                'parent_id'   => null,
                'name'        => 'Cửa hàng',
                'icon'        => null,
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
//            ])
                 ->registerItem([
                    'id'          => 'cms-store-order',
                    'priority'    => 1,
                    'parent_id'   => 'cms-store',
                    'name'        => 'Đơn hàng',
                    'icon'        => null,
                    'url'         => route('ecommerce.orders.index'),
                    'permissions' => [
                        'ecommerce.orders.index',
                    ],
                    'active'      => false,
                ])
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
                    'id'          => 'cms-store-currency-manager',
                    'priority'    => 1,
                    'parent_id'   => 'cms-store',
                    'name'        => 'Currencies',
                    'icon'        => null,
                    'url'         => route('ecommerce.currencies.index'),
                    'permissions' => [
                        'ecommerce.currencies.index',
                        'ecommerce.currencies.create',
                        'ecommerce.currencies.update',
                        'ecommerce.currencies.destroy',
                    ],
                    'active'      => false,
                ])->registerItem([
                    'id'          => 'cms-store-shipping-methods',
                    'priority'    => 1,
                    'parent_id'   => 'cms-store',
                    'name'        => 'Shipping',
                    'icon'        => null,
                    'url'         => route('ecommerce.shipping.shipping_methods'),
                    'permissions' => [
                        'ecommerce.brands.index',
                    ],
                    'active'      => false,
                ])->registerItem([
                    'id'          => 'cms-store-settings-manager',
                    'priority'    => 1,
                    'parent_id'   => 'cms-store',
                    'name'        => 'Settings',
                    'icon'        => null,
                    'url'         => route('ecommerce.settings'),
                    'permissions' => [
                        'ecommerce.brands.index',
                    ],
                    'active'      => false,
                ]);
        });
    }

    public function registerMenuOptions()
    {
        if (Gate::allows('ecommerce.categories.index', Auth::user())) {
            $type = Category::class;
            $name = trans('plugins/ecommerce::ecommerce.categories');
            $list = app(CategoryRepository::class)->all();

            if ($list->isNotEmpty()) {
                echo view('plugins.ecommerce::menu', compact('list', 'name', 'type'));
            }
        }



//        if (Gate::allows('ecommerce.brands.index', Auth::user())) {
//            $type = Brand::class;
//            $name = trans('plugins/ecommerce::ecommerce.brand');
//            $list = app(BrandRepository::class)->all();
//
//            if ($list->isNotEmpty()) {
//                echo view('plugins.ecommerce::menu', compact('list', 'name', 'type'));
//            }
//        }
    }

    public function registerTopHeaderNotification($options)
    {
        if (Gate::allows('ecommerce.orders.update', Auth::user())) {
            $orders = $this->setPendingOrder();

            if ($orders->count() == 0) {
                return $options;
            }

            return $options . view('plugins.ecommerce::partials.notification', compact('orders'))->render();
        }

        return $options;
    }

    protected function setPendingOrder()
    {
        if (!$this->pendingOrders) {
            $this->pendingOrders = $this->app->make(OrderRepository::class)
                ->findWhere([
                    'status'                => BaseStatusEnum::PENDING,
                    'is_finished' => 1,
                ]);
        }

        return $this->pendingOrders;
    }
}
