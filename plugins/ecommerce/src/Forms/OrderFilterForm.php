<?php

namespace Ocart\Ecommerce\Forms;

use Illuminate\Support\Facades\URL;
use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Ecommerce\Enums\OrderStatusEnum;

class OrderFilterForm extends FormAbstract
{
    protected $template = 'core::forms.form-filter';

    public function buildForm()
    {

        $this
            ->setModuleName('page-filter')
            ->add('query', Field::TEXT, [
                'label' => trans('packages/page::pages.search.label'),
                'wrapper_class' => 'col-span-4',
                'attr' => [
                    'placeholder' => trans('packages/page::pages.search.placeholder'),
                ]
            ])->add('status', Field::SELECT, [
                'label' => trans('plugins/ecommerce::orders.status'),
                'choices'    => OrderStatusEnum::labels(),
                'labels'    => OrderStatusEnum::labels(),
                'wrapper_class' => 'col-span-2',
                'attr' => [
                    'placeholder' => '--Select status--',
                ]
            ]);
    }

    public function processVariable($field)
    {
        $values = \Arr::wrap($field->getValue());
        $res = [];
        foreach ($values as $val) {
            $res[] = $field->getOption('labels')[$val];
        }
        return join(',', $res);
    }
}
