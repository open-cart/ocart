<?php
namespace Ocart\Attribute\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class AttributeGroupForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->setupModel(new AttributeGroup())
            ->withCustomFields()
            ->setModuleName('attribute_groups')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('title', Field::TEXT, [
                'label'      => trans('plugins/attribute::attributes.title'),
            ])
            ->add('slug', Field::TEXT, [
                'label'      => trans('plugins/attribute::attributes.slug'),
            ])
            ->addMetaBoxes([
                'table_attributes' => [
                    'title' => trans('plugins/attribute::attributes.attribute_list'),
                    'content' => apply_filters(
                        'table_attributes',
                        view('plugins.attribute::attributes', ['group' => $this->model, 'form' => $this]),
                        $this
                    )
                ],
            ])
            ->add('status', 'select', [
                'label'      => trans('admin.status'),
                'choices'    => BaseStatusEnum::labels()
            ])->add('display_layout', 'select', [
                'label'      => trans('plugins/attribute::attributes.display_layout'),
                'choices'    => [
                    1 => 'Dropdown swatch'
                ]
            ])->add('is_searchable', 'onOff', [
                'label'      => trans('plugins/attribute::attributes.is_searchable'),
            ])->add('is_comparable', 'onOff', [
                'label'      => trans('plugins/attribute::attributes.is_comparable'),
            ])->add('is_use_in_product_listing', 'onOff', [
                'label'      => trans('plugins/attribute::attributes.is_use_in_product_listing'),
            ])
            ->add('order', Field::TEXT, [
                'label'      => trans('plugins/attribute::attributes.order'),
                'default_value' => 0
            ])
            ->setBreakFieldPoint('status');
    }
}
