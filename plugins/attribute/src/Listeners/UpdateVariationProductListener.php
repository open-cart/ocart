<?php

namespace Ocart\Attribute\Listeners;
use Ocart\Attribute\Services\StoreProductVersionService;
use Ocart\Core\Events\UpdatedContentEvent;
use Ocart\Ecommerce\Models\Product;

class UpdateVariationProductListener
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
     * @param  UpdatedContentEvent  $event
     * @return void
     */
    public function handle(UpdatedContentEvent $event)
    {
        $this->{'updateVariation'. ucfirst(PRODUCT_MODULE_SCREEN_NAME)}($event);
    }

    protected function updateVariationProduct(UpdatedContentEvent $e)
    {
        /** @var Product $product */
        $product = $e->data;

        $this->storeProductVersionService->execute($e->request, $product);
    }
}
