<?php

namespace Ocart\EcommerceReview\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-store-review',
                'priority'    => 99,
                'parent_id'   => 'cms-store',
                'name'        => 'Reviews',
                'icon'        => null,
                'url' => route('ec_review.reviews.index'),
                'permissions' => [
                    'ec_review.reviews.index',
                    'ec_review.reviews.destroy'
                ],
                'active'      => false,
            ]);
        });
    }

}