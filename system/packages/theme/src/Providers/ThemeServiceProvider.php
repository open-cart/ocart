<?php


namespace Ocart\Theme\Providers;


use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Theme\Facades\Theme;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Theme\Facades\ThemeOption;

class ThemeServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->setNamespace('packages/theme')
            ->loadAndPublishConfigurations([])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();

        AliasLoader::getInstance([
            'Theme' => Theme::class,
            'ThemeOption' => ThemeOption::class
        ]);

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ThemeManagementServiceProvider::class);
        $this->app->register(HookServiceProvider::class);

        parent::register();
    }

    public function boot()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-plugins-themes',
                    'priority'    => 1,
                    'parent_id'   => 'cms-plugins',
                    'name'        => trans('packages/theme::theme.name'),
                    'icon'        => null,
                    'url'         => route('themes.index'),
                    'permissions' => [
                        'themes.index'
                    ],
                    'active'      => false,
                ])->registerItem([
                    'id'          => 'cms-plugins-theme-options',
                    'priority'    => 1,
                    'parent_id'   => 'cms-plugins',
                    'name'        => trans('packages/theme::theme.theme_options'),
                    'icon'        => null,
                    'url'         => route('theme.options'),
                    'permissions' => [
                        'themes.index'
                    ],
                    'active'      => false,
                ]);
        });
    }
}
