<?php

namespace Ocart\SeoHelper\Listeners;


use Ocart\SeoHelper\Facades\SeoHelper;
use Prettus\Repository\Events\RepositoryEntityCreated;
use \Exception;
use Prettus\Repository\Events\RepositoryEntityUpdated;

class UpdatedContentListener
{
    /**
     * Handle the event.
     *
     * @param RepositoryEntityUpdated $event
     * @return void
     *
     */
    public function handle(RepositoryEntityUpdated $event)
    {
        try {
            SeoHelper::saveMetaData($event->getModel(), request(), $event->getRepository());
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}