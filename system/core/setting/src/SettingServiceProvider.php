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

        Event::listen(RouteMatched::class, function () {
            config()->set('repository.cache.enabled', is_enable_cache());
            config()->set('repository.cache.minutes', setting('cache_time', 10) * 60);
        });
    }

    public function boot()
    {
        $this
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations(['email', 'permissions', 'general'])
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
                        'settings.email'
                    ],
                    'active' => false,
                ])->registerItem([
                    'id' => 'cms-core-settings-slug',
                    'parent_id' => 'cms-core-settings',
                    'name' => 'Permalink',
                    'icon' => null,
                    'url' => route('slug.settings'),
                    'permissions' => [
                        'settings.slug'
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
