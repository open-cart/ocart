<?php


namespace Ocart\SeoHelper\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Ocart\SeoHelper\Listeners\CreatedContentListener;
use Ocart\SeoHelper\Listeners\DeletedContentListener;
use Ocart\SeoHelper\Listeners\UpdatedContentListener;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityDeleted;
use Prettus\Repository\Events\RepositoryEntityUpdated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        RepositoryEntityCreated::class => [
            CreatedContentListener::class
        ],
        RepositoryEntityUpdated::class => [
            UpdatedContentListener::class
        ],
        RepositoryEntityDeleted::class => [
            DeletedContentListener::class
        ]
    ];
}
