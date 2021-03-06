<?php

namespace Ocart\Attribute\Listeners;

use Ocart\Attribute\Services\StoreProductVersionService;
use Ocart\Core\Events\CreatedContentEvent;
use Ocart\Ecommerce\Models\Product;

class AddAttributeProductListener
{

    protected $storeProductVersionService;

    /**
     * Create the event listener.
     * @param StoreProductVersionService $storeProductVersionService
     */
    public function __construct(
        StoreProductVersionService $storeProductVersionService
    )
    {
        $this->storeProductVersionService = $storeProductVersionService;
    }

    /**
     * Handle the event.
     *
     * @param CreatedContentEvent $event
     * @return void
     */
    public function handle(CreatedContentEvent $event)
    {
        if (method_exists($this, 'addAttribute' . ucfirst($event->screen))) {
            $this->{'addAttribute' . ucfirst($event->screen)}($event);
        }
    }

    protected function addAttributeProduct(CreatedContentEvent $e)
    {
        /** @var Product $product */
        $product = $e->data;

        $this->storeProductVersionService->execute($e->request, $product);
    }
}
