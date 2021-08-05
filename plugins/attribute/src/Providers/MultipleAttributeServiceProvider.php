<?php

namespace Ocart\Attribute\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Attribute\Repositories\Caches\AttributeCacheDecorator;
use Ocart\Attribute\Repositories\Caches\AttributeGroupCacheDecorator;
use Ocart\Attribute\Repositories\Caches\ProductVariationCacheDecorator;
use Ocart\Attribute\Repositories\Caches\ProductVariationItemCacheDecorator;
use Ocart\Attribute\Repositories\Caches\ProductWithAttributeGroupCacheDecorator;
use Ocart\Attribute\Repositories\Criteria\IsVariationCriteria;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationItemRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Ecommerce\Models\Product;

class MultipleAttributeServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(AttributeRepository::class, AttributeCacheDecorator::class);
        $this->app->bind(AttributeGroupRepository::class, AttributeGroupCacheDecorator::class);
        $this->app->bind(ProductVariationRepository::class, ProductVariationCacheDecorator::class);
        $this->app->bind(ProductVariationItemRepository::class, ProductVariationItemCacheDecorator::class);
        $this->app->bind(ProductWithAttributeGroupRepository::class, ProductWithAttributeGroupCacheDecorator::class);
    }

    public function boot()
    {
        $this
            ->setBasePath(base_path() . '/')
            ->setNamespace('plugins/attribute')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();

        add_filter(BASE_FILTER_TABLE_QUERY, function ($repo) {
            if ($repo->getModel() instanceof Product) {
                $repo->pushCriteria(app(IsVariationCriteria::class));
            }

            return $repo;
        });
    }
}