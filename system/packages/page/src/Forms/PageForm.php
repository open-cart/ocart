<?php
namespace Ocart\Page\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Page\Models\Page;
use Ocart\Page\Supports\Template;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class PageForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->setupModel(new Page())
            ->withCustomFields()
            ->setModuleName('page')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('packages/page::pages.forms.name'),
            ])
            ->add('slug', Field::TEXT, [
                'label'      => trans('admin.alias'),
            ])
            ->add('description', Field::TEXTAREA, [
                'label'      => trans('packages/page::pages.description'),
                'attr'      => [
                    'rows' => 3
                ]
            ])
            ->add('content', Field::TEXTAREA, [
                'label'      => trans('packages/page::pages.content'),
                'attr' => [
                    'class' => $this->formHelper->getConfig('defaults.field_class') . ' editor-full'
                ]
            ])
//            ->add('is_featured', 'onOff')
            ->add('status', 'select', [
                'label'      => trans('admin.status'),
                'choices'    => BaseStatusEnum::labels()
            ])->add('template', 'select', [
                'label'      => trans('admin.template'),
                'choices'    => Template::getTemplate()
            ])
            ->setBreakFieldPoint('status');
    }
}
