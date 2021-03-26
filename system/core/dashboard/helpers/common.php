<?php

if (!function_exists('dashboard_builder')) {
    /**
     * @return \Ocart\Dashboard\Supports\DashboardWidgetBuilder
     */
    function dashboard_builder() {
        return app(\Ocart\Dashboard\Supports\DashboardWidgetBuilder::class);
    }
}

if (!function_exists('add_dashboard_widget')) {
    /**
     * @param int $priority
     * @return \Ocart\Dashboard\Supports\DashboardWidgetBuilder
     */
    function add_dashboard_widget($priority = 99) {
        $widget = dashboard_builder();

        add_filter(DASHBOARD_FILTER_ADMIN_LIST,function ($widgets, $settings) use (&$widget) {
            return $widget->init($widgets, $settings);
        }, $priority, 2);

        return $widget;
    }
}