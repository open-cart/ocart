<?php


namespace Ocart\Page\Providers;


use Illuminate\Support\ServiceProvider;
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

            SeoHelper::setTitle($page->name);
            SeoHelper::setDescription($page->description);

            $meta = SeoHelper::openGraph();
            $meta->setTitle($page->name);
            $meta->setDescription($page->description);
            $meta->setUrl($page->url);
            $meta->setType('article');

            if ($page->template) {
                Theme::layout($page->template);
            }

            do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, PAGE_MODULE_SCREEN_NAME, $page);

            return [
                'page' => $page
            ];
        });
    }

    public function boot()
    {
        if (function_exists('shortcode')) {
            view()->composer(['theme::page'], function (View $view) {
                $view->withShortcodes();
            });
        }
    }
}
