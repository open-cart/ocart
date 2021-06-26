<?php
use Ocart\Menu\Repositories\MenuRepository;

if (!function_exists('main_navigation')) {
    function main_navigation() {
        $menuRepository = app(MenuRepository::class);

        return $menuRepository->with('menuNodes')->find(setting('main_navigation'))->menuNodes;
    }
}

if (!function_exists('header_navigation')) {
    function header_navigation() {
        $menuRepository = app(MenuRepository::class);

        return $menuRepository->with('menuNodes')->find(setting('header_navigation'));
    }
}

if (!function_exists('footer_navigation')) {
    function footer_navigation() {
        $menuRepository = app(MenuRepository::class);

        return $menuRepository->with('menuNodes')->find(setting('footer_navigation'));
    }
}