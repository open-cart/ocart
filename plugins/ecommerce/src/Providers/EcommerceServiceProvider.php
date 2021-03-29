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
            ->loadAndPublishConfigurations(['ecommerce'])
            ->loadMigrations();

        $this->app->bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(TagRepository::class, TagRepositoryEloquent::class);
        $this->app->bind(BrandRepository::class, BrandRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {

    }
}
