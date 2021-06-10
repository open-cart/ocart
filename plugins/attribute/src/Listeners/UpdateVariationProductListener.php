<?php

namespace Ocart\Attribute\Listeners;

use Illuminate\Support\Str;
use Ocart\Attribute\Models\ProductVariation;
use Ocart\Attribute\Models\ProductVariationItem;
use Ocart\Attribute\Models\ProductWithAttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationItemRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Core\Events\UpdatedContentEvent;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

class UpdateVariationProductListener
{

    protected $productRepository;

    protected $attributeRepository;

    protected $productVariationRepository;

    protected $productVariationItemRepository;

    protected $productWithAttributeGroupRepository;

    /**
     * Create the event listener.
     *
     * @param ProductRepository $productRepository
     * @param ProductVariationRepository $productVariationRepository
     * @param ProductVariationItemRepository $productVariationItemRepository
     * @param ProductWithAttributeGroupRepository $productWithAttributeGroupRepository
     * @param AttributeRepository $attributeRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductVariationRepository $productVariationRepository,
        ProductVariationItemRepository $productVariationItemRepository,
        ProductWithAttributeGroupRepository $productWithAttributeGroupRepository,
        AttributeRepository $attributeRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->productVariationItemRepository = $productVariationItemRepository;
        $this->productWithAttributeGroupRepository = $productWithAttributeGroupRepository;
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

        $productRelated = $this->productVariationRepository
            ->with('product')
            ->findByField('configurable_product_id', $product->id);
        $productDefault = $productRelated->where('is_default', 1)->first();

        if ($productDefault->product_id == $e->request->input('variation_default_id')) {
            return;
        }

        $this->productVariationRepository->update(['is_default' => 0], $productDefault->id);

        $this->productVariationRepository->updateOrCreate([
            'product_id' => $e->request->input('variation_default_id'),
            'configurable_product_id' => $product->id
        ],['is_default' => 1]);

        $data = [];

        $data['price'] = $productDefault->product->price;
        $data['sale_price'] = $productDefault->product->sale_price;

        $this->productRepository->update($data, $product->id);
    }
}
