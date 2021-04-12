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
                'priority' => 1,
                'parent_id' => null,
                'name' => 'Contact',
                'icon' => null,
                'url' => '',
                'permissions' => [],
                'active' => false,
            ])
                ->registerItem([
                    'id' => 'cms-contact-management',
                    'priority' => 1,
                    'parent_id' => 'cms-contact',
                    'name' => 'Contact',
                    'icon' => null,
                    'url' => route('contacts.index'),
                    'permissions' => [
                        'ecommerce.orders.index',
                    ],
                    'active' => false,
                ]);
        });

        add_shortcode('contact-form', 'contact-form', 'Contact Form', function () {
            $view = apply_filters(CONTACT_FORM_TEMPLATE_VIEW, 'plugins.contact::shortcode.contact');

           return view($view);
        });
    }
}