<?php


namespace Ocart\Theme\Providers;


use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(theme_path(setting('theme') . '/views'), 'theme');
        $this->app->booted(function () {
            $themeRoute = theme_path(setting('theme') . '/routes/web.php');
            if (File::exists($themeRoute)) {
                $this->loadRoutesFrom($themeRoute);
            }

            $this->loadRoutesFrom(__DIR__ . '/../../routes/public.php');
        });
    }
}
