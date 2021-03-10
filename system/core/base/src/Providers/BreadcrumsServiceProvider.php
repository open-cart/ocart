<?php


namespace Ocart\Core\Providers;


use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class BreadcrumsServiceProvider extends BaseServiceProvider
{

    public function register(): void
    {
        parent::register();
        Breadcrumbs::register('dashboard', function (BreadcrumbsGenerator $breadcrumbs) {
            $breadcrumbs->push('Home', route('dashboard'));
        });

        /**
         * Register breadcrumbs based on menu stored in session
         */
        Breadcrumbs::register('main', function (BreadcrumbsGenerator $breadcrumbs, $defaultTitle = null) {
            if (Route::currentRouteName() != 'dashboard') {
                $breadcrumbs->parent('dashboard');
//                $breadcrumbs->push($defaultTitle, URL::current());
            }

            $prefix = '/' . ltrim($this->app->make('request')->route()->getPrefix(), '/');
            $url = URL::current();
            $arMenu = dashboard_menu()->getAll();
            $found = false;
            foreach ($arMenu as $item) {
                foreach ($item['children'] as $key => $menuCategory) {
                    if (($url == $menuCategory['url'] || (Str::contains($menuCategory['url'],
                                    $prefix) && $prefix != '//')) && !empty($menuCategory['name'])) {
                        $found = true;
                        $breadcrumbs->push(trans($menuCategory['name']), $menuCategory['url']);
                        if ($defaultTitle != trans($menuCategory['name'])) {
                            $breadcrumbs->push($defaultTitle, $menuCategory['url']);
                        }
                        break;
                    }
                }

            }
        });
    }

    public function boot(): void
    {
        parent::boot();
    }
}
