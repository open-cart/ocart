<?php

namespace Ocart\Attribute\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Attribute\Repositories\AttributeGroupRepositoryEloquent;
use Ocart\Attribute\Repositories\AttributeRepositoryEloquent;
use Ocart\Attribute\Repositories\Criteria\IsVariationCriteria;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationItemRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Attribute\Repositories\ProductVariationItemRepositoryEloquent;
use Ocart\Attribute\Repositories\ProductVariationRepositoryEloquent;
use Ocart\Attribute\Repositories\ProductWithAttributeGroupRepositoryEloquent;
use Ocart\Core\Library\Helper;
use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Ecommerce\Models\Product;

class MultipleAttributeServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(AttributeGroupRepository::class, AttributeGroupRepositoryEloquent::class);
        $this->app->bind(AttributeRepository::class, AttributeRepositoryEloquent::class);
        $this->app->bind(ProductVariationItemRepository::class, ProductVariationItemRepositoryEloquent::class);
        $this->app->bind(ProductVariationRepository::class, ProductVariationRepositoryEloquent::class);
        $this->app->bind(ProductWithAttributeGroupRepository::class, ProductWithAttributeGroupRepositoryEloquent::class);
    }

    public function boot()
    {
        $this
            ->setBasePath(base_path() .'/')
            ->setNamespace('plugins/attribute')
            ->loadAndPublishConfigurations([])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();

        add_filter(BASE_FILTER_TABLE_QUERY, function(RepositoriesAbstract $repo) {
            if ($repo->getModel() instanceof Product) {
                $repo->pushCriteria(app(IsVariationCriteria::class));
            }

            return $repo;
        });
    }
}