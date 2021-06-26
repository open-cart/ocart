<?php

namespace Ocart\Attribute\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Kris\LaravelFormBuilder\Form;
use Ocart\Attribute\Listeners\AddAttributeProductListener;
use Ocart\Attribute\Listeners\UpdateVariationProductListener;
use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Attribute\Models\ProductVariation;
use Ocart\Attribute\Models\ProductVariationItem;
use Ocart\Attribute\Models\ProductWithAttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Core\Events\CreatedContentEvent;
use Ocart\Core\Events\UpdatedContentEvent;
use Ocart\Ecommerce\Models\Order;
use Ocart\Ecommerce\Models\Product;

class HookServiceProvider extends ServiceProvider
{

    public function register()
    {
        if (is_active_plugin('ecommerce')) {
            Product::resolveRelationUsing('version', function (Product $q) {
                return $q->hasMany(ProductVariation::class, 'configurable_product_id');
            });

            Product::resolveRelationUsing('attributes', function (Product $q) {
                return $q->hasMany(ProductVariationItem::class, 'product_id');
            });

            Product::resolveRelationUsing('attribute_groups', function (Product $q) {
                return $q->hasMany(ProductWithAttributeGroup::class, 'product_id');
            });

            Product::fire(function ($model) {
                $model->mergeFillable([
                    'is_variation',
                ]);
            });
        }

        Event::listen(CreatedContentEvent::class, AddAttributeProductListener::class);
        Event::listen(UpdatedContentEvent::class, UpdateVariationProductListener::class);
    }

    public function boot()
    {
        add_filter(BASE_FILTER_BEFORE_RENDER_FORM, [$this, 'addMetaBoxeLocation'], 150, 3);

        add_filter(ORDER_RENDER_TABLE_ORDER_CREATE, function() {
            return view('plugins.attribute::orders.render-table-order');
        });

        add_filter(ORDER_RENDER_TABLE_ORDER_UPDATE, function($res, Order $order) {
            $products = $order->products()->with('product.version.product.attributes.attribute')->get();
            return view('plugins.attribute::orders.render-table-order-update', compact('order', 'products'));
        }, 1, 2);

        add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $product) {
            if ($screen === ECOMMERCE_PRODUCT_MODULE_SCREEN_NAME) {
                /** @var ProductVariationRepository $productVariationRepository */
                $productVariationRepository = app(ProductVariationRepository::class);

                $attributeGroup = $product->attribute_groups()->with('attributeGroup')->get();
                $productVariation = $product->version()->with('items')->get();

                $productRelated = $productVariationRepository
                    ->with(['product','items.attribute'])
                    ->findByField('configurable_product_id', $product->id);

                $product->attribute_groups = $attributeGroup;
                $product->product_variation = $productVariation;
                $product->product_related = $productRelated;
            }
        }, 1, 2);

        $this->registerMenu();
    }

    protected function registerMenu()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-store-attributes',
                'priority' => 1,
                'parent_id' => 'cms-store',
                'name' => 'Thuộc tính',
                'icon' => null,
                'url' => route('ecommerce.attribute_groups.index'),
                'permissions' => [
                    'ecommerce.orders.index',
                ],
                'active' => false,
            ]);
        });
    }

    /**
     * @param Form $form
     * @param $module
     * @param $model
     * @return mixed
     */
    public function addMetaBoxeLocation($form, $module, $model)
    {
        if ($module !== 'ecommerce_product') {
            return $form;
        }

        /** @var ProductWithAttributeGroupRepository $productWithAttributeGroupRepository */
        $productWithAttributeGroupRepository = app(ProductWithAttributeGroupRepository::class);

        /** @var ProductVariationRepository $productVariationRepository */
        $productVariationRepository = app(ProductVariationRepository::class);

        /** @var AttributeGroupRepository $attributeGroupRepository */
        $attributeGroupRepository = app(AttributeGroupRepository::class);

        $hasVariation = false;

        if ($model->id) {
            $hasVariation = !!$productVariationRepository->findByField('configurable_product_id', $model->id)->first();
        }

        $allGroup = $attributeGroupRepository->with('attributes')->all();

        if (!$hasVariation) {
            $form->addMetaBoxes([
                'attributes' => [
                    'title' => trans('plugins/attribute::attributes.attributes'),
                    'content' => apply_filters(
                        'variations',
                        view('plugins.attribute::products.add-product-attributes', [
                            'group' => $allGroup,
                            'form' => $form,
                        ]),
                        $form
                    ),
                    'wrap' => false
                ],
            ]);
            return $form;
        }

        $group = $productWithAttributeGroupRepository
            ->with('attributeGroup.attributes')
            ->findWhere([
                'product_id' => $model->id
            ]);

        $productRelated = $productVariationRepository
            ->with(['product','items.attribute'])
            ->findByField('configurable_product_id', $model->id);

        $form->addMetaBoxes([
            'variations' => [
                'title' => trans('plugins/attribute::attributes.product_has_variations'),
                'content' => apply_filters(
                    'variations',
                    view('plugins.attribute::products.configurable', [
                        'group' => $group,
                        'allGroup' => $allGroup,
                        'productRelated' => $productRelated,
                        'form' => $form,
                    ]),
                    $form
                ),
                'wrap' => false
            ],
        ]);

        if ($productRelated->isNotEmpty()) {
            $form->removeMetaBox('overview');
            $form->remove('images[]');
        }

        return $form;
    }
}
