<?php
namespace Ocart\Blog\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class TagForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->withCustomFields()
            ->setModuleName('product')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('plugins/ecommerce::products.forms.name'),
//                'rules' => 'min:5',
            ])
            ->add('slug', Field::TEXT, [
//                'rules' => 'min:5',
            ])
            ->add('description', Field::TEXTAREA, [
                'rules' => 'max:400'
            ])

            ->add('status', 'select', [
                'choices'    => BaseStatusEnum::labels()
            ])
            ->setBreakFieldPoint('status');
    }
}
