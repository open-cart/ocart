<?php

namespace App\Providers;

use App\Repositories\LanguageRepository;
use App\Repositories\LanguageRepositoryEloquent;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(LanguageRepository::class, LanguageRepositoryEloquent::class);

        AbstractPaginator::defaultView('pagination.tailwind');
//        AbstractPaginator::defaultSimpleView('pagination::simple-tailwind');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
