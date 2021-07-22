<?php

namespace Ocart\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Listeners\CleanCacheRepository;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Prettus\Repository\Events\RepositoryEntityCreated' => [
            CleanCacheRepository::class
        ],
        'Prettus\Repository\Events\RepositoryEntityUpdated' => [
            CleanCacheRepository::class
        ],
        'Prettus\Repository\Events\RepositoryEntityDeleted' => [
            CleanCacheRepository::class
        ]
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $events = app('events');

        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function listens()
    {
        return $this->listen;
    }
}
