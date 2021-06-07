<?php
namespace Ocart\CateImage\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class CateImageServiceProvider extends ServiceProvider
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
            ->setNamespace('plugins/cateimage')
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadMigrations();
    }
}