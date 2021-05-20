<?php
namespace Ocart\Acl\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Forms\FormAbstract;

class UserFilterForm extends FormAbstract
{
    protected $template = 'core::forms.form-filter';

    public function buildForm()
    {
        $this
            ->setModuleName('page-filter')->add('name', Field::TEXT, [
                'label'      => trans('packages/acl::users.search.label'),
                'wrapper_class' => 'col-span-2',
                'attr' => [
                    'placeholder' => trans('packages/acl::users.search.placeholder'),
                ]
            ]);
    }
}
