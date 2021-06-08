<?php

namespace Ocart\Attribute\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Attribute\Repositories\AttributeGroupRepositoryEloquent;
use Ocart\Attribute\Repositories\AttributeRepositoryEloquent;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class MultipleAttributeServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(AttributeGroupRepository::class, AttributeGroupRepositoryEloquent::class);
        $this->app->bind(AttributeRepository::class, AttributeRepositoryEloquent::class);
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
    }
}