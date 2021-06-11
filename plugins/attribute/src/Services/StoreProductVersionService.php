<?php

namespace Ocart\Attribute\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationItemRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

class StoreProductVersionService
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

    public function execute(Request $request, Product $product)
    {
        $hasVariation = !!$this->productVariationRepository
            ->findByField('configurable_product_id', $product->id)
            ->first();

        if (!$hasVariation) {
            $this->addVersion($request, $product);
            return;
        }

        $this->updateVersion($request, $product);
    }

    public function addVersion(Request $request, Product $product)
    {
        $addedAttributes = json_decode($request->input('variations', '[]'), true);

        if (!$request->input('is_added_attributes') || empty($addedAttributes)) {
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
        $productRelatedVariation['images'] = json_encode($product->images);

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

    public function updateVersion(Request $request, Product $product)
    {
        $productRelated = $this->productVariationRepository
            ->with('product')
            ->findByField('configurable_product_id', $product->id);
        $productDefault = $productRelated->where('is_default', 1)->first();

        if ($productDefault->product_id == $request->input('variation_default_id')) {
            return;
        }

        $this->productVariationRepository->update(['is_default' => 0], $productDefault->id);

        $this->productVariationRepository->updateOrCreate([
            'product_id' => $request->input('variation_default_id'),
            'configurable_product_id' => $product->id
        ],['is_default' => 1]);

        $productNewDefault = $this->productRepository->find($request->input('variation_default_id'));
        $data = [];

        $data['price'] = $productNewDefault->price;
        $data['sale_price'] = $productNewDefault->sale_price;
        $data['images'] = json_encode($productNewDefault->images);

        $this->productRepository->update($data, $product->id);
    }
}