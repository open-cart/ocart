<?php


namespace Ocart\Setting;


use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Facades\EmailHandler;
use Ocart\Setting\Repositories\SettingRepository;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class SettingServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->setNamespace('core/setting')
            ->loadAndPublishConfigurations(['general']);

        $this->app->bind(SettingRepository::class,);

        Helper::autoload(__DIR__ . '/../helpers');
    }


    public function boot()
    {
        $this
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations(['email'])
            ->loadMigrations()
            ->publishAssets();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-core-settings',
                'priority' => 998,
                'parent_id' => null,
                'name' => 'Settings',
                'icon' => null,
                'url' => '',
                'permissions' => [],
                'active' => false,
            ])
                ->registerItem([
                    'id' => 'cms-core-settings-general',
                    'parent_id' => 'cms-core-settings',
                    'name' => 'General',
                    'icon' => null,
                    'url' => route('settings.options'),
                    'permissions' => [
                        'settings.options'
                    ],
                    'active' => false,
                ])
                ->registerItem([
                    'id' => 'cms-core-settings-email',
                    'parent_id' => 'cms-core-settings',
                    'name' => 'Email',
                    'icon' => null,
                    'url' => route('settings.email'),
                    'permissions' => [
                        'pages.index',
                        'pages.create',
                        'pages.update',
                        'pages.destroy',
                    ],
                    'active' => false,
                ]);

            EmailHandler::addTemplateSettings('base', config('core.setting.email', []));
        });
    }

    protected function providers()
    {
        return [
            SettingStore::class,
            SettingManager::class,
        ];
    }
}
