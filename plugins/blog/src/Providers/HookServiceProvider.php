<?php

namespace Ocart\Blog\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{

    public function register()
    {
        add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions']);
    }

    public function registerMenuOptions()
    {
        if (Gate::allows('blog.categories.index', Auth::user())) {
            $type = \Ocart\Blog\Repositories\Interfaces\CategoryRepository::class;
            $name = trans('plugins/blog::menu.categories');
            $list = app($type)->all();

            if ($list->isNotEmpty()) {
                echo view('plugins.blog::menu', compact('list', 'name', 'type'));
            }
        }

        if (Gate::allows('blog.tags.index', Auth::user())) {
            $type = \Ocart\Blog\Repositories\Interfaces\TagRepository::class;
            $name = trans('plugins/blog::menu.tags');
            $list = app($type)->all();

            if ($list->isNotEmpty()) {
                echo view('plugins.blog::menu', compact('list', 'name', 'type'));
            }
        }
    }
}