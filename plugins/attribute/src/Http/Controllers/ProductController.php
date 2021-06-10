<?php

namespace Ocart\Attribute\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ocart\Attribute\Http\Requests\ProductVariationCreateRequest;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationItemRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

class ProductController extends BaseController
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
     * Thêm mới biến thể.
     * @param ProductVariationCreateRequest $request
     */
    public function storeVariation(
        ProductVariationCreateRequest $request,
        BaseHttpResponse $response
    )
    {
        DB::beginTransaction();

        $addedAttributes = $request->input('attributes', []);

        /** @var Product $product */
        $product = $this->productRepository->find($request->get('product_id'));

        $allVersions = $this->productVariationRepository
            ->with(['items'])
            ->findByField('configurable_product_id', $product->id);

        $allVersionsPluck = $allVersions->pluck('items.*.attribute_id', 'product_id');

        $newVersionAttr = array_map(function ($item) {
            return $item['attribute_id'];
        }, $addedAttributes);

        foreach ($allVersionsPluck as $version) {
            $a = array_diff($newVersionAttr, $version);
            $b = array_diff($version, $newVersionAttr);
            if (!$a && !$b) {
                return $response->setError()->setMessage(trans('plugins/attribute::attributes.variation_existed'));
            }
        }

        /** @var Product $productRelatedVariation */
        $productRelatedVariation = $this->productRepository->getModel();

        $productRelatedVariation->fill($product->toArray());

        $slug = $productRelatedVariation->slug;
        $sku = $productRelatedVariation->sku;

        foreach ($addedAttributes as $item) {
            $attribute = $this->attributeRepository->findByField('id', $item['attribute_id'])->first();
            if ($attribute) {
                $sku .= '-' . Str::upper($attribute->slug);
                $slug .= '-' . Str::lower($attribute->slug);
            }
        }

        $existsSku = $this->productRepository->findByField('sku', $sku);

        if ($existsSku->isNotEmpty()) {
            $sku = $productRelatedVariation->sku . '-' . create_sku();
            $slug = $productRelatedVariation->slug . '-' . create_sku();
        }

        $productRelatedVariation->sku = $sku;
        $productRelatedVariation->slug = $slug;
        $productRelatedVariation->slug_md5 = md5($productRelatedVariation->slug);
        $productRelatedVariation->is_variation = 1;

        $productRelatedVariation = $productRelatedVariation->toArray();
        $productRelatedVariation['images'] = json_encode($request->input('images', $productRelatedVariation['images']));
        $productRelatedVariation['price'] = $request->input('price', $productRelatedVariation['price']);
        $productRelatedVariation['sale_price'] = $request->input('sale_price', $productRelatedVariation['sale_price']);

        $productRelatedVariation = $this->productRepository->create($productRelatedVariation);

        $this->productVariationRepository->create([
            'product_id' => $productRelatedVariation->id,
            'configurable_product_id' => $product->id,
            'is_default' => 0
        ]);

        foreach ($addedAttributes as $item) {
            $this->productVariationItemRepository->create([
                'attribute_id' => $item['attribute_id'],
                'product_id' => $productRelatedVariation->id,
            ]);
        }

        DB::commit();

        return $response->setMessage(trans('plugins/attribute::attributes.added_variation_success'));
    }
}