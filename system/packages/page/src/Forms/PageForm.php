<?php
namespace Ocart\Page\Forms;

use Kris\LaravelFormBuilder\Field;
use System\Core\Forms\FormAbstract;
use Kris\LaravelFormBuilder\Fields\FormField;

class PageForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->withCustomFields()
            ->setModuleName('page')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('packages/page::pages.forms.name'),
                'rules' => 'min:5',
            ])
            ->add('slug', Field::TEXT, [
                'rules' => 'min:5',
            ])
            ->add('description', Field::TEXTAREA, [
                'rules' => 'max:5000'
            ])
            ->add('content', Field::TEXTAREA, [
                'rules' => 'max:5000'
            ])
            ->add('is_featured', 'onOff');
    }
}
