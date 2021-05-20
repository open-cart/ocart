<?php
namespace Ocart\Blog\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Blog\Models\Tag;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class TagForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->setupModel(new Tag())
            ->withCustomFields()
            ->setModuleName('blog_tag')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('plugins/blog::tags.name'),
            ])
            ->add('slug', Field::TEXT, [
                'label'      => trans('admin.alias'),
            ])
            ->add('description', Field::TEXTAREA, [
                'label'      => trans('plugins/blog::tags.description'),
                'attr' => [
                    'class' => $this->formHelper->getConfig('defaults.field_class') . ' editor-inline'
                ]
            ])

            ->add('status', 'select', [
                'label'      => trans('admin.status'),
                'choices'    => BaseStatusEnum::labels()
            ])
            ->setBreakFieldPoint('status');
    }
}
