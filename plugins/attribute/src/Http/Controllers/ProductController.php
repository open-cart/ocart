<?php

namespace Ocart\Attribute\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ocart\Attribute\Http\Requests\ProductAddVersionRequest;
use Ocart\Attribute\Repositories\Criteria\IsVariationCriteria;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationItemRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Repositories\Criteria\ProductSearchCriteria;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Media\Facades\TnMedia;

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
     * @param ProductAddVersionRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function addVersion(
        ProductAddVersionRequest $request,
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

    public function getVersion($id, BaseHttpResponse $response)
    {
        $product = $this->productRepository->find($id);

        $images = array_map(function ($item) {
            return TnMedia::url($item);
        }, $product->images);

        $attributes = $this->productVariationItemRepository->with('attribute')->findByField('product_id', $id);

        return $response->setData(compact('attributes', 'product', 'images'))
            ->setMessage('success');
    }

    public function updateVersion($id, Request $request, BaseHttpResponse $response)
    {
        DB::beginTransaction();

        $addedAttributes = $request->input('attributes', []);

        /** @var Product $product */
        $product = $this->productRepository->find($request->get('product_id'));

        $allVersions = $this->productVariationRepository
            ->with(['items'])
            ->findWhere([
                [
                    'product_id',
                    '<>',
                    $id
                ],
                'configurable_product_id' => $product->id
            ]);

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

        $data = $request->only('price', 'sku', 'sale_price');
        $data['images'] = json_encode($request->input('images', []));

        $productRelatedVariation = $this->productRepository->update($data, $id);

        foreach ($addedAttributes as $item) {
            $this->productVariationItemRepository->updateOrCreate([
                'id' => isset($item['item_id']) ? $item['item_id'] : null,
                'product_id' => $productRelatedVariation->id,
            ], [
                'attribute_id' => $item['attribute_id'],
                'product_id' => $productRelatedVariation->id,
            ]);
        }

        DB::commit();

        return $response->setMessage(trans('plugins/attribute::attributes.updated_variation_success'));
    }

    public function deleteVersion(Request $request, BaseHttpResponse $response)
    {
        DB::beginTransaction();

        $productId = $request->input('id');

        $this->productRepository->delete($productId);

        $variation = $this->productVariationRepository
            ->findByField('product_id', $productId)
            ->first();

        $this->productVariationRepository->deleteWhere([
            'product_id' => $productId
        ]);

        /**
         * Nếu xóa phiên bản mặc định, thì sẽ tự động chuyển phiên bản mặc định cho một
         * phiên bản khác trong sản phẩm, nếu không còn phiên bản nào khác, thì chuyển sản phẩm
         * về sản phẩm thường. và xóa luôn nhóm thuộc tính của sản phẩm.
         */
        if ($variation->is_default == 1) {
            $version = $this->productVariationRepository
                ->findByField('configurable_product_id', $variation->configurable_product_id)
                ->first();
            if ($version) {
                $this->productVariationRepository->update(['is_default' => 1], $version->id);

                $data = [];
                $productNewDefault = $this->productRepository->find($version->product_id);

                $data['price'] = $productNewDefault->price;
                $data['sale_price'] = $productNewDefault->sale_price;
                $data['images'] = json_encode($productNewDefault->images);

                $this->productRepository->update($data, $version->configurable_product_id);
            } else {
                $this->productWithAttributeGroupRepository->deleteWhere([
                    'product_id' => $variation->configurable_product_id
                ]);
            }
        }

        $this->productVariationItemRepository->deleteWhere([
            'product_id' => $request->input('id')
        ]);

        DB::commit();

        return $response->setMessage('success');
    }

    public function updateAttribute(Request $request, BaseHttpResponse $response)
    {
        $attributeGroupIds = $request->input('attribute_group_id', []);
        $product_id = $request->input('product_id', null);

        DB::beginTransaction();

        $allAttributeGroups = $this->productWithAttributeGroupRepository
            ->findByField('product_id', $product_id)
            ->pluck('attribute_group_id')->toArray();

        $idDelete = array_values(array_diff($allAttributeGroups, $attributeGroupIds));

        $idInsert = array_values(array_diff($attributeGroupIds, $allAttributeGroups));

        // Các nhóm thuộc tính bị xóa khỏi sản phẩm
        if (count($idDelete)) {
            $this->productWithAttributeGroupRepository->scopeQuery(function ($q) use ($idDelete) {
                return $q->whereIn('attribute_group_id', $idDelete);
            })->deleteWhere([
                'product_id' => $product_id,
            ]);

            /** @var Collection $allVersions */
            $allVersions = $this->productVariationRepository
                ->with('items.attribute')
                ->findByField('configurable_product_id', $product_id)
                ->pluck('items')->flatten();

            $idVariationItem = $allVersions->filter(function ($item) use ($idDelete) {
                return in_array($item->attribute->attribute_group_id, $idDelete);
            })->pluck('id')->toArray();

            if (count($idVariationItem)) {
                $this->productVariationItemRepository->scopeQuery(function ($q) use ($idVariationItem) {
                    return $q->whereIn('id', $idVariationItem);
                })->deleteWhere([]);
            }
        }

        // Các nhóm thuộc tính được thêm vào sản phẩm
        if (count($idInsert)) {
            foreach ($idInsert as $item) {
                $this->productWithAttributeGroupRepository->create([
                    'product_id' => $product_id,
                    'attribute_group_id' => $item,
                    'order' => 0
                ]);
            }
        }

        DB::commit();

        return $response->setMessage('success');
    }


    public function getSearchProducts()
    {
        $products = $this->productRepository
            ->pushCriteria(ProductSearchCriteria::class)
            ->pushCriteria(IsVariationCriteria::class)
            ->with(['version.product.attributes.attribute'])
            ->paginate(5);

        return view('plugins.attribute::products.get-search-products', compact('products'));
    }
}