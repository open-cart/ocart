<?php
namespace Ocart\Acl\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class AclServiceProvider extends ServiceProvider
{
    use  LoadAndPublishDataTrait;

    public function register()
    {
        parent::register();
    }

    public function boot()
    {
        $this->setNamespace('packages/acl')
            ->loadAndPublishConfigurations([])
//            ->loadRoutes(['web'])
//            ->loadAndPublishViews()
//            ->loadAndPublishTranslations()
            ->loadMigrations();
    }
}