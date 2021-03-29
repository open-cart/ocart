<?php
namespace Ocart\Ecommerce\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class CategoryForm extends FormAbstract
{

    public function buildForm()
    {
        $list = get_categories();

        $categories = [];
        foreach ($list as $row) {
            if ($this->getModel() && $this->model->id === $row->id) {
                continue;
            }

            $categories[$row->id] = $row->indent_text . ' ' . $row->name;
        }
        $categories = [0 => 'None'] + $categories;

        $this
            ->withCustomFields()
            ->setModuleName('product')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('plugins/ecommerce::products.forms.name'),
//                'rules' => 'min:5',
            ])
            ->add('parent_id', 'select', [
                'choices'    => $categories
            ])
            ->add('slug', Field::TEXT, [
//                'rules' => 'min:5',
            ])
            ->add('description', Field::TEXTAREA, [
                'rules' => 'max:400',
                'attr' => [
                    'class' => $this->formHelper->getConfig('defaults.field_class') . ' editor-inline'
                ]
            ])

            ->add('status', 'select', [
                'choices'    => BaseStatusEnum::labels()
            ])
            ->setBreakFieldPoint('status');
    }
}
