<?php
namespace Ocart\Octane\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Events\UpdatedContentEvent;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class OctaneServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Event::listen(UpdatedContentEvent::class, function (UpdatedContentEvent $event) {
            $screenSupport = [
                SYSTEM_MODULE_THEME_ACTIVE_SCREEN_NAME,
                SYSTEM_MODULE_THEME_UPDATE_SCREEN_NAME,
                SYSTEM_MODULE_PLUGIN_MANAGEMENT_SCREEN_NAME
            ];
            if (in_array($event->screen, $screenSupport)) {
                if (app()->has('octane')) {
                    shell_exec("cd " . base_path() . " && php artisan octane:reload");
                }
            }
        });
    }

    public function boot()
    {

    }
}