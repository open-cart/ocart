<?php


namespace Ocart\Page\Providers;


use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Page\TestMiddleware;
use Ocart\SeoHelper\Facades\SeoHelper;

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

            do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, PAGE_MODULE_SCREEN_NAME, $page);

            return [
                'page' => $page
            ];
        });
    }
}
