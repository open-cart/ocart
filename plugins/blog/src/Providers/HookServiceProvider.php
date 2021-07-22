<?php

namespace Ocart\Blog\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Ocart\Blog\Models\Category;
use Ocart\Blog\Widgets\PostStatsWidget;

class HookServiceProvider extends ServiceProvider
{

    public function register()
    {
        add_dashboard_widget()
            ->setTitle('Posts')
            ->setKey('post_stats_widget')
            ->setIcon('fa fa-edit')
            ->create(PostStatsWidget::class);

        add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions']);
    }

    public function registerMenuOptions()
    {
        if (Gate::allows('blog.categories.index', Auth::user())) {
            $type = Category::class;
            $name = trans('plugins/blog::menu.categories');
            $list = app(\Ocart\Blog\Repositories\Interfaces\CategoryRepository::class)->all();

            if ($list->isNotEmpty()) {
                echo view('plugins.blog::menu', compact('list', 'name', 'type'));
            }
        }

//        if (Gate::allows('blog.tags.index', Auth::user())) {
//            $type = Tag::class;
//            $name = trans('plugins/blog::menu.tags');
//            $list = app(\Ocart\Blog\Repositories\Interfaces\TagRepository::class)->all();
//
//            if ($list->isNotEmpty()) {
//                echo view('plugins.blog::menu', compact('list', 'name', 'type'));
//            }
//        }
    }
}
