<?php

namespace Ocart\SeoHelper\Listeners;


use Ocart\SeoHelper\Facades\SeoHelper;
use \Exception;
use Prettus\Repository\Events\RepositoryEntityDeleted;

class DeletedContentListener
{
    /**
     * Handle the event.
     *
     * @param RepositoryEntityDeleted $event
     * @return void
     *
     */
    public function handle(RepositoryEntityDeleted $event)
    {
        try {
            SeoHelper::deleteMetaData($event->getModel(), 'seo_meta');
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}