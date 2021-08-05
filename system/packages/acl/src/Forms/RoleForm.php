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
        $permissions = $this->getAvailablePermissions();

        $prTree = $this->getPermissionTree($permissions);

        $active = [];

        if ($this->getModel()) {
            $active = $this->getModel()->permissions;
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

    protected function getAvailablePermissions()
    {
        $permissions = [];

        $types = [
            'core' => platform_path('core'),
            'packages' => platform_path('packages'),
            'plugins' => plugin_path(),
        ];

        foreach ($types as $type => $path) {
            $permissions = array_merge($permissions, $this->getAvailablePermissionForEachType($type, $path));
        }

        return $permissions;
    }

    protected function getAvailablePermissionForEachType($type, $path)
    {
        $permissions = [];

        foreach (scan_folder($path) as $module) {
            $configuration = config(strtolower($type . '.' . $module . '.permissions'));
            if (!empty($configuration)) {
                foreach ($configuration as $config) {
                    $permissions[$config['flag']] = $config;
                }
            }
        }

        return $permissions;
    }

    protected function getPermissionTree($permissions)
    {
        $sortedFlag = $permissions;
        sort($sortedFlag);
        $children['root'] = $this->getChildren('root', $sortedFlag);

        foreach (array_keys($permissions) as $key) {
            $childrenReturned = $this->getChildren($key, $permissions);
            if (count($childrenReturned) > 0) {
                $children[$key] = $childrenReturned;
            }
        }

        return $children;
    }

    /**
     * @param int $parentId
     * @param array $allFlags
     * @return mixed
     */
    protected function getChildren($parentId, array $allFlags)
    {
        $newFlagArray = [];
        foreach ($allFlags as $flagDetails) {
            if (Arr::get($flagDetails, 'parent_flag', 'root') == $parentId) {
                $newFlagArray[] = $flagDetails['flag'];
            }
        }
        return $newFlagArray;
    }
}
