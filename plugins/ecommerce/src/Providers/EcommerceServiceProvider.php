<?php
namespace Ocart\Ecommerce\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Facades\Slug;
use Ocart\Ecommerce\Facades\EcommerceHelper;
use Ocart\Ecommerce\Models\Brand;
use Ocart\Ecommerce\Models\Category;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Models\Tag;
use Ocart\Ecommerce\Repositories\BrandRepositoryEloquent;
use Ocart\Ecommerce\Repositories\CategoryRepositoryEloquent;
use Ocart\Ecommerce\Repositories\CurrencyRepositoryEloquent;
use Ocart\Ecommerce\Repositories\CustomerAddressRepositoryEloquent;
use Ocart\Ecommerce\Repositories\CustomerRepositoryEloquent;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CurrencyRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerAddressRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderAddressRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderHistoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShipmentHistoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShipmentRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShippingRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShippingRuleRepository;
use Ocart\Ecommerce\Repositories\Interfaces\StoreRepository;
use Ocart\Ecommerce\Repositories\Interfaces\TagRepository;
use Ocart\Ecommerce\Repositories\Interfaces\TaxRepository;
use Ocart\Ecommerce\Repositories\OrderAddressRepositoryEloquent;
use Ocart\Ecommerce\Repositories\OrderHistoryRepositoryEloquent;
use Ocart\Ecommerce\Repositories\OrderProductRepositoryEloquent;
use Ocart\Ecommerce\Repositories\OrderRepositoryEloquent;
use Ocart\Ecommerce\Repositories\ProductRepositoryEloquent;
use Ocart\Ecommerce\Repositories\ShipmentHistoryRepositoryEloquent;
use Ocart\Ecommerce\Repositories\ShipmentRepositoryEloquent;
use Ocart\Ecommerce\Repositories\ShippingRepositoryEloquent;
use Ocart\Ecommerce\Repositories\ShippingRuleRepositoryEloquent;
use Ocart\Ecommerce\Repositories\StoreRepositoryEloquent;
use Ocart\Ecommerce\Repositories\TagRepositoryEloquent;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Ecommerce\Repositories\TaxRepositoryEloquent;
use Ocart\SeoHelper\Facades\SeoHelper;

class EcommerceServiceProvider extends ServiceProvider {
    use  LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this
            ->setBasePath(base_path() .'/')
            ->setNamespace('plugins/ecommerce')
            ->loadRoutes([
                'web',
                'order',
                'customer',
                'shipping'
            ])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations(['ecommerce', 'general', 'email'])
            ->loadMigrations();

        $this->app->bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(TagRepository::class, TagRepositoryEloquent::class);
        $this->app->bind(BrandRepository::class, BrandRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(CurrencyRepository::class, CurrencyRepositoryEloquent::class);

        $this->app->bind(OrderRepository::class, OrderRepositoryEloquent::class);
        $this->app->bind(OrderAddressRepository::class, OrderAddressRepositoryEloquent::class);
        $this->app->bind(OrderProductRepository::class, OrderProductRepositoryEloquent::class);
        $this->app->bind(OrderHistoryRepository::class, OrderHistoryRepositoryEloquent::class);

        $this->app->bind(CustomerRepository::class, CustomerRepositoryEloquent::class);
        $this->app->bind(CustomerAddressRepository::class, CustomerAddressRepositoryEloquent::class);

        $this->app->bind(StoreRepository::class, StoreRepositoryEloquent::class);
        $this->app->bind(ShippingRepository::class, ShippingRepositoryEloquent::class);
        $this->app->bind(ShippingRuleRepository::class, ShippingRuleRepositoryEloquent::class);
        $this->app->bind(ShipmentRepository::class, ShipmentRepositoryEloquent::class);
        $this->app->bind(ShipmentHistoryRepository::class, ShipmentHistoryRepositoryEloquent::class);
        $this->app->bind(TaxRepository::class, TaxRepositoryEloquent::class);

        AliasLoader::getInstance(['EcommerceHelper' => EcommerceHelper::class]);

        Slug::registerPrefix(Product::class, [
            'label' => 'Product',
            'value' => 'product',
        ])->registerPrefix(Category::class, [
            'label' => 'Product Categories',
            'value' => 'product-category',
        ])->registerPrefix(Brand::class, [
            'label' => 'Brands',
            'value' => 'brands',
        ])->registerPrefix(Tag::class, [
            'label' => 'Product Tags',
            'value' => 'product-tag',
        ]);
    }

    public function boot()
    {

        $this->booted(function () {
            SeoHelper::registerModule([Product::class, Tag::class, Brand::class, Category::class]);
        });
    }
}
