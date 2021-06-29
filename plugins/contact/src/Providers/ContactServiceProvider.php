<?php

namespace Ocart\Contact\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Contact\Repositories\ContactRepositoryEloquent;
use Ocart\Contact\Repositories\Interfaces\ContactReplyRepository;
use Ocart\Contact\Repositories\Interfaces\ContactRepository;
use Ocart\Core\Facades\EmailHandler;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class ContactServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');
        $this
            ->setBasePath(base_path() .'/')
            ->setNamespace('plugins/contact')
            ->loadRoutes([
                'web',
            ])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations(['general', 'email'])
            ->loadMigrations();

        $this->app->bind(ContactRepository::class, ContactRepositoryEloquent::class);
        $this->app->bind(ContactReplyRepository::class, ContactRepositoryEloquent::class);
    }

    public function boot()
    {
        Event::listen(RouteMatched::class, function () {
            EmailHandler::addTemplateSettings('contact', config('plugins.contact.email', []));
        });

//        EmailHandler::module('contact')
//            ->preview()
//            ->setVariableValues([
//                'site_logo' => asset('/images/logo-default.jpg')
//            ])
//            ->sendUsingTemplate('plugins.contact::emails.e-contact');
    }
}