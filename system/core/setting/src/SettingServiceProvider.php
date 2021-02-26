<?php


namespace Ocart\Setting;


use Illuminate\Support\ServiceProvider;
use Ocart\Setting\Repositories\SettingRepository;
use System\Core\Library\Helper;
use System\Core\Traits\LoadAndPublishDataTrait;

class SettingServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->setNamespace('core/setting')
            ->loadAndPublishConfigurations(['general']);

        $this->app->bind(SettingRepository::class, );

        Helper::autoload(__DIR__ . '/../helpers');
    }


    public function boot()
    {
        $this
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations([])
            ->loadMigrations()
            ->publishAssets();
    }
}
