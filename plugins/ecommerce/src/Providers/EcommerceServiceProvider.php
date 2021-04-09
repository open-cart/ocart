<?php
namespace Ocart\Ecommerce\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
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
use Ocart\Ecommerce\Repositories\Interfaces\OrderProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\TagRepository;
use Ocart\Ecommerce\Repositories\OrderAddressRepositoryEloquent;
use Ocart\Ecommerce\Repositories\OrderProductRepositoryEloquent;
use Ocart\Ecommerce\Repositories\OrderRepositoryEloquent;
use Ocart\Ecommerce\Repositories\ProductRepositoryEloquent;
use Ocart\Ecommerce\Repositories\TagRepositoryEloquent;
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
                'customer'
            ])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations(['ecommerce', 'general'])
            ->loadMigrations();

        $this->app->bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(TagRepository::class, TagRepositoryEloquent::class);
        $this->app->bind(BrandRepository::class, BrandRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(CurrencyRepository::class, CurrencyRepositoryEloquent::class);

        $this->app->bind(OrderRepository::class, OrderRepositoryEloquent::class);
        $this->app->bind(OrderAddressRepository::class, OrderAddressRepositoryEloquent::class);
        $this->app->bind(OrderProductRepository::class, OrderProductRepositoryEloquent::class);

        $this->app->bind(CustomerRepository::class, CustomerRepositoryEloquent::class);
        $this->app->bind(CustomerAddressRepository::class, CustomerAddressRepositoryEloquent::class);

        AliasLoader::getInstance(['EcommerceHelper' => EcommerceHelper::class]);
    }

    public function boot()
    {

        $this->booted(function () {
            SeoHelper::registerModule([Product::class, Tag::class, Brand::class, Category::class]);
        });
    }
}
