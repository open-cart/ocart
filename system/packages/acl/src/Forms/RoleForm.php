<?php
namespace Ocart\Acl\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Acl\Models\Role;
use Ocart\Core\Forms\FormAbstract;

class RoleForm extends FormAbstract
{

    public function __construct()
    {
        parent::__construct();
    }

    public function buildForm()
    {
        $this
            ->withCustomFields()
            ->setModuleName('page')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('Role name'),
                'rules' => 'required',
            ])->add('description', Field::TEXTAREA, [
                'label'      => trans('Description'),
            ]);
    }
}
