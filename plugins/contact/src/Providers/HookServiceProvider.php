<?php

namespace Ocart\Contact\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Ocart\Contact\Repositories\Interfaces\ContactRepository;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var Collection
     */
    protected $unreadContacts = [];

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

        $this->booted(function () {
            add_filter(BASE_FILTER_TOP_HEADER_LAYOUT, [$this, 'registerTopHeaderNotification'], 120);
        });
    }

    public function registerTopHeaderNotification($options)
    {
        if (Gate::allows('contacts.update', Auth::user())) {
            $contacts = $this->setUnreadContacts();

            if ($contacts->count() == 0) {
                return $options;
            }

            return $options . view('plugins.contact::partials.notification', compact('contacts'))->render();
        }

        return $options;
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function setUnreadContacts()
    {
        if (!$this->unreadContacts) {
            $this->unreadContacts = $this->app->make(ContactRepository::class)
                ->getUnread(['id', 'name', 'email', 'phone', 'created_at']);
        }

        return $this->unreadContacts;
    }
}