<?php


namespace Ocart\Theme\Providers;


use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;
use Ocart\Theme\Facades\Theme;

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
        $theme = Theme::getThemeName();

        if (!empty($theme)) {
            Helper::autoload(theme_path($theme . '/functions'));

            $themePath = theme_path($theme);

            if (File::exists($themePath . '/theme.json')) {
                $attributes = get_file_data($themePath . '/theme.json');

                Theme::setAttributes($attributes);
            }
        }
    }
}
