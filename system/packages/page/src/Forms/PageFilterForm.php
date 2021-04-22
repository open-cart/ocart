<?php
namespace Ocart\Page\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Forms\FormAbstract;

class PageFilterForm extends FormAbstract
{
    protected $template = 'core::forms.form-filter';

    public function buildForm()
    {
        $this
            ->setModuleName('page-filter')->add('name', Field::TEXT, [
                'label'      => trans('packages/page::pages.search.label'),
                'wrapper_class' => 'col-span-2',
                'attr' => [
                    'placeholder' => trans('packages/page::pages.search.placeholder'),
                ]
            ]);
    }
}
