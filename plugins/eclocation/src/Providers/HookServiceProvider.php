<?php

namespace Ocart\EcLocation\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\EcLocation\Forms\ProductLocationForm;
use Ocart\Ecommerce\Models\Product;

class HookServiceProvider extends ServiceProvider
{

    public function register()
    {
        Product::fire(function ($model) {
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

    public function boot()
    {
        add_filter(BASE_FILTER_BEFORE_RENDER_FORM, [$this, 'addMetaBoxeLocation'], 150, 3);
    }

    public function addMetaBoxeLocation($form, $module, $model)
    {
        if ($module !== 'ecommerce_product') {
            return $form;
        }

//        $form->add('address', Field::TEXT, [
//            'label' => trans('plugins/ecommerce::products.forms.name'),
//            'rules' => 'min:5',
//        ]);

        $form->addMetaBoxes([
            'eclocation' => [
                'title' => trans('Thông tin bất động sản'),
                'content' => apply_filters(
                    'product_location_form',
                    $form->getFormBuilder()
                        ->create(ProductLocationForm::class, ['model' => $model])
                        ->renderForm(),
                    $form
                )
            ],
        ]);
        $form->add('bds_type', \Kris\LaravelFormBuilder\Field::SELECT, [
            'label' => 'Loại',
            'choices'    => [
                '1' => 'Bán',
                '2' => 'Cho thuê',
            ]
        ]);

        return $form;
    }
}