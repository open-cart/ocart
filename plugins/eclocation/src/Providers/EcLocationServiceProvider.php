<?php
namespace Ocart\EcLocation\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class EcLocationServiceProvider extends ServiceProvider
{
    use  LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this
            ->setBasePath(base_path() .'/')
            ->setNamespace('plugins/eclocation')
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadMigrations();
    }
}