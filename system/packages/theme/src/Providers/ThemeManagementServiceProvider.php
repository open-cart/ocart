<?php


namespace Ocart\Theme\Providers;


use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;

class ThemeManagementServiceProvider extends ServiceProvider
{

    public function register()
    {
        $theme = setting('theme');
//        if (!empty($theme)) {
//            $this->app->make('translator')->addJsonPath(theme_path($theme . '/lang'));
//        }
    }

    public function boot()
    {
        $theme = setting('theme');
        if (!empty($theme)) {
            Helper::autoload(theme_path($theme . '/functions'));
        }
    }
}
