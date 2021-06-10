<?php

namespace Ocart\Attribute\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Kris\LaravelFormBuilder\Form;
use Ocart\Attribute\Listeners\AddAttributeProductListener;
use Ocart\Attribute\Listeners\UpdateVariationProductListener;
use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Core\Events\CreatedContentEvent;
use Ocart\Core\Events\UpdatedContentEvent;

class HookServiceProvider extends ServiceProvider
{

    public function register()
    {
        if (is_active_plugin('ecommerce')) {
            \Ocart\Ecommerce\Models\Product::fire(function ($model) {
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

        if (!$model->id) {
            /** @var AttributeGroupRepository $attributeGroupRepository */
            $attributeGroupRepository = app(AttributeGroupRepository::class);

            $form->addMetaBoxes([
                'attributes' => [
                    'title' => trans('plugins/attribute::attributes.attributes'),
                    'content' => apply_filters(
                        'variations',
                        view('plugins.attribute::products.add-product-attributes', [
                            'group' => $attributeGroupRepository->with('attributes')->all(),
                            'form' => $form,
                        ]),
                        $form
                    ),
                    'wrap' => false
                ],
            ]);
            return $form;
        }

        /** @var ProductWithAttributeGroupRepository $productWithAttributeGroupRepository */
        $productWithAttributeGroupRepository = app(ProductWithAttributeGroupRepository::class);

        /** @var ProductVariationRepository $productVariationRepository */
        $productVariationRepository = app(ProductVariationRepository::class);

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