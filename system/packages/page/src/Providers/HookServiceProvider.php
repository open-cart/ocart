<?php


namespace Ocart\Page\Providers;


use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Ocart\Page\Repositories\PageRepository;
use Ocart\SeoHelper\Facades\SeoHelper;
use Ocart\Shortcode\View\View;
use Ocart\Theme\Facades\Theme;

class HookServiceProvider extends ServiceProvider
{

    public function register()
    {
        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, function ($slug) {
            $repo = $this->app->make(PageRepository::class);

            $page = $repo->scopeQuery(function($query) {
                return $query;//->where('status', '1');
            })->findByField('slug', $slug)->first();

            if (!$page) {
                return [];
            }

            $description = Str::limit(strip_tags($page->description), 250);

            SeoHelper::setTitle($page->name);
            SeoHelper::setDescription($description);

            $meta = SeoHelper::openGraph();
            $meta->setTitle($page->name);
            $meta->setDescription($description);
            $meta->setUrl($page->url);
            $meta->setType('article');
            SeoTools::jsonLd()->setUrl(null);
//            SeoTools::jsonLd()->addValue('auth', 'nguyenpl117@gmail.com');

            if ($page->template) {
                Theme::layout($page->template);
            }

            do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, PAGE_MODULE_SCREEN_NAME, $page);

            return [
                'page' => $page
            ];
        });

        add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions']);
    }

    public function boot()
    {
        if (function_exists('shortcode')) {
            view()->composer(['theme::page'], function (View $view) {
                $view->withShortcodes();
            });
        }
    }

    public function registerMenuOptions()
    {
        echo view('packages.page::menu-option');
    }
}
