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
use Ocart\Ecommerce\Repositories\Caches\BrandCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\CategoryCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\CurrencyCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\CustomerAddressCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\CustomerCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\OrderAddressCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\OrderCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\OrderHistoryCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\OrderProductCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\ProductCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\ShipmentCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\ShipmentHistoryCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\ShippingCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\ShippingRuleCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\StoreCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\TagCacheDecorator;
use Ocart\Ecommerce\Repositories\Caches\TaxCacheDecorator;
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
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
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

        $this->app->bind(ProductRepository::class, ProductCacheDecorator::class);
        $this->app->bind(TagRepository::class, TagCacheDecorator::class);
        $this->app->bind(BrandRepository::class, BrandCacheDecorator::class);
        $this->app->bind(CategoryRepository::class, CategoryCacheDecorator::class);
        $this->app->bind(CurrencyRepository::class, CurrencyCacheDecorator::class);

        $this->app->bind(OrderRepository::class, OrderCacheDecorator::class);
        $this->app->bind(OrderAddressRepository::class, OrderAddressCacheDecorator::class);
        $this->app->bind(OrderProductRepository::class, OrderProductCacheDecorator::class);
        $this->app->bind(OrderHistoryRepository::class, OrderHistoryCacheDecorator::class);

        $this->app->bind(CustomerRepository::class, CustomerCacheDecorator::class);
        $this->app->bind(CustomerAddressRepository::class, CustomerAddressCacheDecorator::class);

        $this->app->bind(StoreRepository::class, StoreCacheDecorator::class);
        $this->app->bind(ShippingRepository::class, ShippingCacheDecorator::class);
        $this->app->bind(ShippingRuleRepository::class, ShippingRuleCacheDecorator::class);
        $this->app->bind(ShipmentRepository::class, ShipmentCacheDecorator::class);
        $this->app->bind(ShipmentHistoryRepository::class, ShipmentHistoryCacheDecorator::class);
        $this->app->bind(TaxRepository::class, TaxCacheDecorator::class);

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
