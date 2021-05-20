<?php
namespace Ocart\Acl\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Acl\Models\Role;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class UserForm extends FormAbstract
{

    public function __construct()
    {
        parent::__construct();
    }

    public function buildForm()
    {
        $roles = ['' => trans('packages/acl::users.select_role')] + Role::all()->pluck('name', 'id')->toArray();

        $this
            ->withCustomFields()
            ->setModuleName('page')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('packages/acl::users.full_name'),
            ])
            ->add('email', Field::TEXT, [
                'label'      => trans('packages/acl::users.email'),
                'rules' => 'email',
                'attr' => [
                    'disabled' => !!$this->getModel()
                ]
            ])->add('password', Field::PASSWORD, [
                'label'      => trans('packages/acl::users.password'),
                'value' => '',
            ])->add('password_confirmation', Field::PASSWORD, [
                'label'      => trans('packages/acl::users.password_confirmation'),
            ])
            ->add('roles', 'select', [
                'label'      => trans('packages/acl::users.roles'),
                'choices'    => $roles
            ])
            ->setBreakFieldPoint('roles');
    }
}
