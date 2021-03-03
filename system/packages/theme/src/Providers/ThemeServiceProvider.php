<?php


namespace Ocart\Theme\Providers;


use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Theme\Facades\Theme;
use System\Core\Library\Helper;
use System\Core\Traits\LoadAndPublishDataTrait;

class ThemeServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        AliasLoader::getInstance([
            'Theme' => Theme::class,
        ]);

        $this->app->register(RouteServiceProvider::class);

        parent::register();
    }

    public function boot()
    {
        $this->setNamespace('packages/theme')
            ->loadAndPublishConfigurations([])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-plugins-themes',
                    'priority'    => 1,
                    'parent_id'   => 'cms-plugins',
                    'name'        => 'Giao diện',
                    'icon'        => null,
                    'url'         => route('themes.index'),
                    'permissions' => [],
                    'active'      => false,
                ]);
        });
    }
}
