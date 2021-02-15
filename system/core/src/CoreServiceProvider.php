<?php

namespace System\Core;

use System\Core\Library\CustomPaginator;
use System\Core\Library\Menu\Html;
use System\Core\Library\Menu\Item;
use System\Core\Library\Menu\Link;
use System\Core\Library\Menu\Menu;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();
        foreach (glob(__DIR__.'/Library/Helpers/*.php') as $filename) {
            require_once $filename;
        }

        $this->app->bind(LengthAwarePaginator::class, CustomPaginator::class);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');
    }

    public function boot()
    {

        // Route Admin
        if (file_exists(__DIR__ . '/Admin/routes.php')) {
            $this->loadRoutesFrom(__DIR__ . '/Admin/routes.php');
        }

        function featherIcon($name) {
            return '<i data-feather="'.$name.'"></i>';
        }

        $menu = Menu::make('admin', function ($menu) {
            $menu->add(
                Html::raw(featherIcon('shopping-cart') . '&nbsp;Cửa hàng'))
                ->as('store')
                ->addChildren(function($menu) {
                    $menu->add(Link::noLink( 'Quản lý đơn hàng'))
                        ->addChildren(function ($menu) {
                            $menu->add(
                                Link::route('admin::page', 'Quản lý đơn hàng')
                                    ->addClass('flex items-center')
                            );
                        });
                });
        });

        Menu::get('admin')->get('store')->addChildren(function ($menu) {
            $menu->add(
                Link::noLink('Sản phẩm & danh mục')
            )->addChildren(function ($menu) {
                $menu->add(
                    Link::route('admin::page', 'Quản lý sản phẩm')
                );
                $menu->add(
                    Link::route('admin::page', 'Quản lý danh mục')
                );

            });
        });


        Menu::make('admin', function ($menu) {
            $menu->add(
                Link::noLink('Tiện ích'),
            )
                ->as('plugins')
                ->addChildren(function ($item) {
                    $item->add(
                        Link::to('', 'Giao diện')
                    );
                    $item->add(
                        Link::route('admin::plugin', 'Phần mở rộng')
                    );
                });

            $menu->add(
                Link::noLink(__('admin.menu_titles.admin_system')),
            )
                ->as('system')
                ->addChildren(function ($item) {
                    $item->add(
                        Link::to('', __('admin.menu_titles.setting_system'))
                    );
                });
        });

        view()->share('adminSidebar', Menu::get('admin'));
    }
}
