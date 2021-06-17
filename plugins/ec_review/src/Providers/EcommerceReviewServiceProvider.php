<?php

namespace Ocart\EcommerceReview\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\EcommerceReview\Repositories\ReviewRepository;
use Ocart\EcommerceReview\Repositories\ReviewRepositoryEloquent;

class EcommerceReviewServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(ReviewRepository::class, ReviewRepositoryEloquent::class);
    }

    public function boot()
    {

        $this
            ->setBasePath(base_path() . '/')
            ->setNamespace('plugins/ec_review')
            ->loadAndPublishConfigurations([])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();

    }
}