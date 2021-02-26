<?php


namespace Ocart\Setting;


use Illuminate\Support\ServiceProvider;
use System\Core\Library\Helper;
use System\Core\Traits\LoadAndPublishDataTrait;

class SettingServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->setNamespace('core/setting');

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
