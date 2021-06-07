<?php

namespace Ocart\CateImage\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\EcLocation\Forms\ProductLocationForm;

class HookServiceProvider extends ServiceProvider
{

    public function register()
    {
        if (is_active_plugin('ecommerce')) {
            \Ocart\Ecommerce\Models\Category::fire(function ($model) {
                $model->mergeFillable([
                    'image',
                    'banner',
                ]);
            });
        }
    }

    public function boot()
    {
        add_filter(BASE_FILTER_BEFORE_RENDER_FORM, [$this, 'addMetaBoxes'], 150, 3);
    }

    public function addMetaBoxes($form, $module, $model)
    {
        if ($module !== 'ecommerce_category') {
            return $form;
        }

        $form->add('image', 'mediaImage', [
            'label' => "Ảnh đại diện",
            'label_attr' => ['class' => 'control-label'],
        ])->add('banner', 'mediaImage', [
            'label' => "Ảnh banner",
            'label_attr' => ['class' => 'control-label'],
        ]);

        return $form;
    }
}