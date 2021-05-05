<?php

namespace Ocart\Contact\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-contact',
                'priority' => 5,
                'parent_id' => null,
                'name' => trans('plugins/contact::contact.menu_manager'),
                'icon' => null,
                'url' => '',
                'permissions' => [],
                'active' => false,
            ])
                ->registerItem([
                    'id' => 'cms-contact-management',
                    'priority' => 1,
                    'parent_id' => 'cms-contact',
                    'name' => trans('plugins/contact::contact.menu'),
                    'icon' => null,
                    'url' => route('contacts.index'),
                    'permissions' => [
                        'ecommerce.orders.index',
                    ],
                    'active' => false,
                ]);
        });

        if (function_exists('add_shortcode')) {
            add_shortcode('contact-form', 'contact-form', 'Contact Form', function ($compile) {
                $view = apply_filters(CONTACT_FORM_TEMPLATE_VIEW, 'plugins.contact::shortcode.contact', $compile);

                if ($compile->view && view()->exists($compile->view)) {
                    $view = $compile->view;
                }

                return view($view, $compile->toArray());
            });
        }
    }
}