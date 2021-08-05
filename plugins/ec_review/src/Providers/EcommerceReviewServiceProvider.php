<?php

namespace Ocart\EcommerceReview\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Ecommerce\Models\Product;
use Ocart\EcommerceReview\Models\Review;
use Ocart\EcommerceReview\Repositories\ReviewRepository;
use Ocart\EcommerceReview\Repositories\ReviewRepositoryEloquent;

class EcommerceReviewServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        if (is_active_plugin('ecommerce')) {
             Product::resolveRelationUsing('reviews', function (Product $q) {
                 return $q->hasMany(Review::class, 'product_id')
                     ->where('status', BaseStatusEnum::PUBLISHED);
             });

             Product::fire(function () {
                 Product::deleting(function($product) {
                     Review::where('product_id', $product->id)->delete();
                 });
             });

            add_filter(BEFORE_QUERY_CRITERIA, function ($query, $old) {
                if ($old instanceof Product) {
                    $query->withCount([
                         'reviews',
                         'reviews as reviews_avg' => function($query) {
                             $query->select(DB::raw('avg(star)'));
                         }
                     ]);
                }
                return $query;
            }, 99, 2);
        }

        $this->app->bind(ReviewRepository::class, ReviewRepositoryEloquent::class);
    }

    public function boot()
    {

        $this
            ->setBasePath(base_path() . '/')
            ->setNamespace('plugins/ec_review')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();

    }
}