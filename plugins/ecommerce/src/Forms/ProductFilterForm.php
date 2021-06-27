<?php

namespace Ocart\Ecommerce\Forms;

use Illuminate\Support\Facades\URL;
use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Ecommerce\Enums\OrderStatusEnum;

class ProductFilterForm extends FormAbstract
{
    protected $template = 'core::forms.form-filter';

    public function buildForm()
    {

        $this
            ->setModuleName('page-filter')
            ->add('name', Field::TEXT, [
                'label' => trans('packages/page::pages.search.label'),
                'wrapper_class' => 'col-span-4',
                'attr' => [
                    'placeholder' => trans('packages/page::pages.search.placeholder'),
                ]
            ])->add('status', Field::SELECT, [
                'label' => trans('plugins/ecommerce::orders.status'),
                'choices'    => BaseStatusEnum::labels(),
                'labels'    => BaseStatusEnum::labels(),
                'wrapper_class' => 'col-span-2',
                'attr' => [
                    'placeholder' => '--Select status--',
                ]
            ])->add('is_featured', Field::SELECT, [
                'label' => trans('plugins/ecommerce::orders.status'),
                'choices'    => [
                    '1' => 'Nổi bật',
                    '2' => 'Không nổi bật'
                ],
                'labels'    => [
                    '1' => 'Nổi bật',
                    '2' => 'Không nổi bật'
                ],
                'wrapper_class' => 'col-span-2',
                'attr' => [
                    'placeholder' => '--Select feature--',
                ]
            ]);
    }
}
