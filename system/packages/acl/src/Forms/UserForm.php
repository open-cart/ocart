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
        $roles = ['' => '- Select Role -'] + Role::all()->pluck('name', 'id')->toArray();

        $this
            ->withCustomFields()
            ->setModuleName('page')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('full_name'),
                'rules' => 'min:5',
            ])
            ->add('email', Field::TEXT, [
                'rules' => 'email',
                'attr' => [
                    'disabled' => !!$this->getModel()
                ]
            ])->add('password', Field::PASSWORD, [
                'label' => 'Password',
                'value' => '',
            ])->add('password_confirmation', Field::PASSWORD, [
                'label' => 'Confirm Password',
            ])
            ->add('roles', 'select', [
                'label'      => 'Role',
                'choices'    => $roles
            ])
            ->setBreakFieldPoint('roles');
    }
}
