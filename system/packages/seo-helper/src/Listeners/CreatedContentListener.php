<?php

namespace Ocart\SeoHelper\Listeners;


use Ocart\SeoHelper\Facades\SeoHelper;
use Prettus\Repository\Events\RepositoryEntityCreated;
use \Exception;

class CreatedContentListener
{
    /**
     * Handle the event.
     *
     * @param RepositoryEntityCreated $event
     * @return void
     *
     */
    public function handle(RepositoryEntityCreated $event)
    {
        try {
            SeoHelper::saveMetaData($event->getModel(), request(), $event->getRepository());
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}