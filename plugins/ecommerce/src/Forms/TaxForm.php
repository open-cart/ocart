<?php
namespace Ocart\Ecommerce\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Ecommerce\Models\Tax;

class TaxForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->setupModel(new Tax())
            ->withCustomFields()
            ->setModuleName('ecommerce_brand')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('title', Field::TEXT, [
                'label'      => trans('plugins/ecommerce::tax.forms.title'),
                'rules'      => ['required'],
                'attr' => [
                    'placeholder' => trans('plugins/ecommerce::tax.forms.title'),
                ]
            ])
            ->add('percentage', Field::NUMBER, [
                'label'      => trans('plugins/ecommerce::tax.forms.percentage'),
                'attr'      =>[
                    'placeholder' => trans('plugins/ecommerce::tax.forms.percentage'),
                ]
            ])
            ->add('priority', Field::NUMBER, [
                'rules' => 'max:400',
                'label'      => trans('plugins/ecommerce::tax.forms.priority'),
                'attr'      => [
                    'placeholder' => trans('plugins/ecommerce::tax.forms.priority'),
                ]
            ])
            ->add('status', 'select', [
                'choices'    => BaseStatusEnum::labels()
            ])
            ->setBreakFieldPoint('status');
    }
}
