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
use Ocart\Core\Events\CreatedContentEvent;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

class AddAttributeProductListener
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
     * @param  CreatedContentEvent  $event
     * @return void
     */
    public function handle(CreatedContentEvent $event)
    {
        $this->{'addAttribute'. ucfirst(PRODUCT_MODULE_SCREEN_NAME)}($event);
    }

    protected function addAttributeProduct(CreatedContentEvent $e)
    {
        /** @var Product $product */
        $product = $e->data;

        $addedAttributes = json_decode($e->request->input('variations', '[]'), true);

        if (!$e->request->input('is_added_attributes') || empty($addedAttributes)) {
            return;
        }

        /** @var Product $productRelatedVariation */
        $productRelatedVariation = $this->productRepository->getModel();

        $productRelatedVariation->fill($product->toArray());

        foreach ($addedAttributes as $item) {
            $attribute = $this->attributeRepository->findByField('id', $item['attribute_id'])->first();
            if ($attribute) {
                $productRelatedVariation->sku .= '-' . Str::upper($attribute->slug);
                $productRelatedVariation->slug .= '-' . Str::lower($attribute->slug);
            }
        }
        $productRelatedVariation->slug_md5 = md5($productRelatedVariation->slug);
        $productRelatedVariation->is_variation = 1;

        $productRelatedVariation = $productRelatedVariation->toArray();
        $productRelatedVariation['images'] = json_encode($productRelatedVariation['images']);
        $productRelatedVariation = $this->productRepository->create($productRelatedVariation);

        $this->productVariationRepository->create([
            'product_id' => $productRelatedVariation->id,
            'configurable_product_id' => $product->id,
            'is_default' => 1
        ]);

        foreach ($addedAttributes as $item) {
            $this->productVariationItemRepository->create([
                'attribute_id' => $item['attribute_id'],
                'product_id' => $productRelatedVariation->id,
            ]);

            $this->productWithAttributeGroupRepository->create([
                'attribute_group_id' => $item['group_id'],
                'product_id' => $product->id,
                'order' => 0
            ]);
        }
    }
}
