<?php
namespace Ocart\Acl\Forms;

use App\Models\User;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Ocart\Acl\Models\Permission;
use Ocart\Acl\Models\Role;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Ecommerce\Forms\ProductOverviewForm;

class RoleForm extends FormAbstract
{

    public function __construct()
    {
        parent::__construct();
    }

    public function buildForm()
    {
        $permissions = Permission::all();

        $prTree = $this->getPermissionTree($permissions);

        $active = [];

        if ($this->getModel()) {
            $active = $this->getModel()->permissions->pluck('id')->toArray();
        }

        $this
            ->withCustomFields()
            ->setModuleName('page')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('packages/acl::roles.name'),
                'rules' => 'required',
            ])->add('description', Field::TEXTAREA, [
                'label'      => trans('packages/acl::roles.description'),
            ])->addMetaBoxes([
                'overview' => [
                    'title' => trans('packages/acl::roles.permission_flag'),
                    'content' => view('packages.acl::roles.permissions', compact('active', 'permissions', 'prTree')),
                ],
            ]);
    }

    protected function getPermissionTree($permissions)
    {
        $res = [];

        foreach ($permissions as $permission) {
            Arr::set($res, $permission->name, $permission);
        }

        return $res;
    }
}
