<?php


namespace Ocart\SeoHelper\Providers;


use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Ocart\SeoHelper\Facades\SeoHelper;

class SeoHelperServiceProvider extends ServiceProvider
{

    public function register()
    {
        add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function () {

        });
    }

    public function boot()
    {
        AliasLoader::getInstance(['SeoHelper' => SeoHelper::class]);
//        $this->app->register(Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class);
    }
}
