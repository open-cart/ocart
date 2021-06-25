<?php
namespace Ocart\Menu\Providers;

use Ocart\Core\Library\Helper;
use \Ocart\Core\Traits\LoadAndPublishDataTrait;
use \Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    use  LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

    }

    public function boot()
    {
    }
}