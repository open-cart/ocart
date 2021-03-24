<?php

namespace Ocart\Media\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Media\Facades\TnMedia;
use Ocart\Media\Repositories\Interfaces\MediaFileRepository;
use Ocart\Media\Repositories\Interfaces\MediaFolderRepository;
use Ocart\Media\Repositories\MediaFileRepositoryEloquent;
use Ocart\Media\Repositories\MediaFolderRepositoryEloquent;

class MediaServiceProvider extends ServiceProvider
{
    use  LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        AliasLoader::getInstance(['TnMedia' => TnMedia::class,]);

        $this->app->bind(MediaFileRepository::class, MediaFileRepositoryEloquent::class);
        $this->app->bind(MediaFolderRepository::class, MediaFolderRepositoryEloquent::class);
    }

    public function boot()
    {
        $this->setNamespace('packages/media')
            ->loadAndPublishConfigurations(['media'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'media');

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-media',
                'priority'    => 199,
                'parent_id' => null,
                'name' => 'Media',
                'icon' => null,
                'url' => '',
                'permissions' => [],
                'active' => false,
            ])->registerItem([
                'id' => 'cms-media-management',
                'parent_id' => 'cms-media',
                'name' => 'Media',
                'icon' => null,
                'url' => route('media.index'),
                'permissions' => [
                    'media.index'
                ],
                'active' => false,
            ]);
        });
    }
}
