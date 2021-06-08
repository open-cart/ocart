<?php

namespace Ocart\Attribute\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Kris\LaravelFormBuilder\Form;
use Ocart\EcLocation\Forms\ProductLocationForm;

class HookServiceProvider extends ServiceProvider
{

    public function register()
    {
        if (is_active_plugin('ecommerce')) {
            \Ocart\Ecommerce\Models\Product::fire(function ($model) {
                $model->mergeFillable([
                    'district_id',
                    'province_id',
                    'address',
                    'location',
                    'acreage',
                    'bds_type',
                ]);
            });
        }
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
            return $form;
        }

        $form->removeMetaBox('overview');
        $form->remove('images[]');

        return $form;
    }
}